<link rel="stylesheet" type="text/css" href="/css/weather.css">
<h3>{{$idea->destination }}'s Weather Forecast</h3>
<div>
    @foreach ($weathers as $weather)
        <div>
            <table>
                <tr>
                    <th>{{ \Carbon\Carbon::parse($weather['date'])->format('F d') }}</th>
                </tr>
                <tr>
                    <th><img src="http://openweathermap.org/img/wn/{{ $weather['weatherIcon'] }}.png"
                             alt="Weather Icon">{{ $weather['weatherIconPhrase'] }}</th>
                </tr>
                <tr>
                    <th>{{ $weather['temperatureMin'] }} - {{ $weather['temperatureMax'] }}°C</th>
                </tr>
            </table>
        </div>
    @endforeach
</div>
