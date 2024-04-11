@extends('layouts.app')


@section('script')
    <script async
            src="https://maps.googleapis.com/maps/api/js?
            key={{config('api.google_map')}}&libraries=places&callback=initMap">
    </script>
    <script type="module" src="/js/map.js"></script>

@endsection

@section('content')
    <div>show</div>

    <div id="map" style="width: 100%; height: 400px;"></div>
@endsection
