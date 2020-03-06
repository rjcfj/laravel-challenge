<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Mail\Invite;
use Validator;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{

    protected $event;

    public function __construct(Event $event)
    {
        $this->middleware('auth');
        $this->event = $event;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filtersQuery[] = ['user_id', Auth::user()->id];
        $filter = [];

        if ($request->get) {
            $filter = ['get' => $request->get];
            switch ($request->get) {
                case 'next':
                    $filtersQuery[] = ['start', '<', Carbon::today()->addDays(5) ];
                    $filtersQuery[] = ['end', '>=', Carbon::today()];
                    break;
                case 'today':
                    $filtersQuery[] = ['start', '<', Carbon::today()->addDays(1) ];
                    $filtersQuery[] = ['end', '>=', Carbon::today()];
                    break;
            }
        }

        $events = $this->event->where($filtersQuery)->paginate(10);
        return view('event.index', compact('events', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $event = $this->event->create($input);
        flash()->success("Event: <b>{$event->title}</b> Event created!");
        return redirect()->route('event.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->event->findOrFail($id);
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Validator::make($request->all(), [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
        ]);
        
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $event = $this->event->findOrFail($id);
        $event->update($input);
        flash()->success("Event: <b>{$event->title}</b> Event updated!");
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->event->findOrFail($id);
        $event->delete();
        flash()->success("Event: <b>{$event->title}</b> Event deleted!");
        return redirect()->route('event.index');
    }

    public function import()
    {
        Excel::load(Input::file('file'), function ($reader){
            $reader->each(function ($sheet){
                $stringPostData=[];        
                $array = array_filter($sheet->toArray());
                foreach ($array as $key => $value) {
                    $stringPostData[$key] = $value;
                    $stringPostData['user_id'] = Auth::user()->id;
                    $stringPostData['created_at'] = Carbon::now()->format('Y-m-d H:i');
                    $stringPostData['updated_at'] = Carbon::now()->format('Y-m-d H:i');
                }

                if (!empty($stringPostData)) {
                    $event = $this->event->create($stringPostData);
                }
            });
        });

        flash()->success("Events imported!");
        return redirect()->route('event.index');
    }

    public function export($id)
    {   
        if ($id == 'null') {
            $events = $this->event->where('user_id', Auth::user()->id)->get()->toArray();
        } else {
            $events = $this->event->where('id', $id)->get()->toArray();
        }

        return Excel::create('calendar', function ($excel) use ($events) {
            $excel->sheet('Event', function ($sheet) use ($events) {
                    $sheet->fromArray($events);
            });
        })->export('csv');

    }

    public static function mail(Request $request, $id)
    {
        $emails = explode(',', preg_replace('/\s*/m', '', $request->emails));
        foreach ($emails as $email) {
            Mail::to($email)->send(new Invite($id));
        }

        flash()->success("Invite(s) sent!");
        return redirect()->route('event.index');

    }   
}
