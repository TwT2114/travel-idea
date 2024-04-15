<div class="card bg-dark p-2 mb-3">
    <h5>Weather List</h5>
    @foreach ($weathers as $weather)
        <div class="media-body d-inline-block rounded mb-1">
            <div>
                <h6 class="mt-0 mb-1">{{ \Carbon\Carbon::parse($weather['date'])->format('F d, Y') }}</h6>

                <p class="mb-0"><img src="http://openweathermap.org/img/wn/{{ $weather['weatherIcon'] }}.png"
                        alt="Weather Icon">
                    {{ $weather['weatherIconPhrase'] }}
                    <span class="mb-0 ms-3">{{ $weather['temperatureMin'] }} -
                        {{ $weather['temperatureMax'] }}°C</span>
                </p>
            </div>
        </div>
    @endforeach
</div>
