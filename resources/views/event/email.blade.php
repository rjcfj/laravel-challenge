<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <a href="{{ url('/event') }}" target="_blank">Calendar</a>
                        </td>
                    </tr>

                    <tr>
                        <td width="100%">
                            <table align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <h1>Hello, Your are being invited by {{$user->name}}.</h1>
                                        <br>
                                        <p>
                                            <br><br>
                                            Titile: {{$event->title}}<br>
                                            From:<br>
                                            {{\Carbon\Carbon::parse($event->start_at)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($event->start_at)->format('H:i')}}<br>
                                            To:<br>
                                            {{\Carbon\Carbon::parse($event->end_at)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($event->end_at)->format('H:i')}}<br>
                                            Description: {{$event->description}}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>