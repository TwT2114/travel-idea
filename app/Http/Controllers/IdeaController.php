<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ideas = Idea::latest()->withCount('comments')->get();
        return view('idea.index', compact('ideas'));

    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $ideas = Idea::withCount('comments')// find number of comments
            ->where(function ($query) use ($searchTerm) {
                $query->where('destination', 'like', '%' . $searchTerm . '%')
                    ->orWhere('tags', 'like', '%' . $searchTerm . '%');
        })->get();

        $plans = Plan::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%');
        })
            ->get();

        return view('search', compact('ideas', 'plans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create a new idea
        $idea = new Idea();
        return view("idea.create", compact("idea"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store the new idea into database
        // 1. validate the inputted data
        $request->validate([
            'title' => 'required | max:255 |min:3',
            'destination' => 'required | max:255',
            'start_date' => 'required | date',
            'end_date' => 'required | date | after_or_equal:start_date',
            'tags' => 'required'

        ]);
        $destination = $request->get(key: 'destination');
        // 调用Google Maps Geocoding API获取地理信息
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [

            'address' => $destination,
            'key' => config('api.google_map')
        ]);
        $geocodingData = $response->json();

        //若获取失败，则返回空值
        $location = $geocodingData['status'] === 'OK'
            ? $geocodingData['results'][0]['geometry']['location']
            : null;
        $latitude = $location['lat'] ?? null;
        $longitude = $location['lng'] ?? null;
        // 2. create a new idea model
        $idea = new Idea([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'title' => $request->get('title'),
            'destination' => $destination,
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'tags' => $request->get('tags')
        ]);
        $idea->latitude = $latitude;
        $idea->longitude = $longitude;
        // 3. save the data into database
        $idea->save();
        return redirect(route('idea.index'))->with('success', 'Idea has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // show the idea
        $idea = Idea::find($id);
        return view('idea.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // edit the idea
        $idea = Idea::find($id);
        // check if the idea is created by the current user
        if ($idea->user_id == Auth::id()) {
            return view('idea.edit', compact('idea'));
        } else {
            return redirect(route('idea.index'))->with('error', 'Idea has been updated');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //1. validate the inputted data
        $request->validate([
            'title' => 'required | max:255 |min:3',
            'destination' => 'required | max:255',
            'start_date' => 'required | date',
            'end_date' => 'required | date | after_or_equal:start_date',
            'tags' => 'required'
        ]);

        //2. Find the Idea from database
        $idea = Idea::find($id);

        //3. set the new values
        $idea->title = $request->get('title');
        $idea->destination = $request->get('destination');
        $idea->start_date = $request->get('start_date');
        $idea->end_date = $request->get('end_date');
        $idea->tags = $request->get('tags');

        // 调用Google Maps Geocoding API获取地理信息
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $idea->destination,
            'key' => config('api.google_map')
        ]);
        $geocodingData = $response->json();

        //若获取失败，则返回空值
        $location = $geocodingData['status'] === 'OK'
            ? $geocodingData['results'][0]['geometry']['location']
            : null;
        $latitude = $location['lat'] ?? null;
        $longitude = $location['lng'] ?? null;
        $idea->latitude = $latitude;
        $idea->longitude = $longitude;

        //4. save the idea into database
        $idea->save();

        return redirect(route('idea.show', $idea->id))->with('success', 'Idea has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get Idea by id
        $idea = Idea::find($id);

        // check if the idea exist
        if ($idea) {
            // check Authorization
            if ($idea->user_id == Auth::id()) {
                $idea->delete();
                return redirect(route('idea.index'))->with('success', 'Idea has been deleted');
            } else {
                return redirect(route('idea.index'))->with('fail', 'No Authorization to delete this idea');
            }
        } else {
            return redirect(route('idea.index'))->with('fail', 'Idea not exist');
        }
    }

    /**
     * get points of interest
     */
    public function getAccessToken()
    {
        $client_id = config('api.amadeus_client_id');
        $client_secret = config('api.amadeus_client_secret');
        $response = Http::asForm()->post('https://test.api.amadeus.com/v1/security/oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        ]);

        $accessToken = $response->json()['access_token'];
        return $accessToken;
    }

    public function getPointsOfInterest(string $id)
    {
        $idea = Idea::find($id);
        $latitude = $idea->latitude;
        $longitude = $idea->longitude;
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://test.api.amadeus.com/v1/reference-data/locations/pois", [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'radius' => 20,
        ]);
        if ($response->status() === 200) {
            $pointsOfInterest = $response->json();
            return view('idea.interest', ['data' => $pointsOfInterest['data']]);
        } else {
            // 如果 API 响应不成功，返回到 idea.show 视图，并显示错误信息
            return redirect(route('idea.show', $idea->id))->with('error', 'Sorry, no points of interest yet');
        }

    }
//天气预报功能
    public function getWeather(Idea $idea)
    {
        $weathers = $this->getCityWeather($idea->destination);
        // 如果$weathers为空或未找到相关数据，显示提示信息
        if (empty($weathers)) {
            return "Cannot find the weather forecast of this place! Please use the city name!";
        }

        $html = view('idea.weather', compact('weathers', 'idea'))->render();
        return $html;
    }
    // 用内置geo api获取经纬度
    public function getCityWeather($destination)
    {
        $apiKey = config('api.weather');
        $getGeoUrl = "http://api.openweathermap.org/geo/1.0/direct?q=" . $destination . "&limit=1&appid=" . $apiKey;
        $geoData = Http::get($getGeoUrl)->throw()->json();

        // 检查$geoData是否为空或不包含所需字段
        if (empty($geoData) || !isset($geoData[0]['lon']) || !isset($geoData[0]['lat'])) {
            return null; // 返回空值表示未找到数据
        }
        //经纬度传递给天气预报API
        $lon = $geoData[0]['lon'];
        $lat = $geoData[0]['lat'];
        $url = "https://api.openweathermap.org/data/2.5/forecast?lat=" . $lat . "&lon=" . $lon . "&appid=" . $apiKey . "&units=metric";
        $response = Http::get($url)->throw()->json();
        // 检查$response是否为空或不包含所需字段
        if (empty($response) || !isset($response['list'])) {
            return null; // 返回空值表示未找到数据
        }
        //提取元素  并做未来五天天气预报
        $weatherData = $this->array_slice_with_step($response['list'], 0, 5, 8);
        foreach ($weatherData as $weather) {
            $tenDaysOfWeatherDataList[] = [
                'date' => explode(" ", $weather['dt_txt'])[0],
                'temperatureMax' => $weather['main']['temp_max'],
                'temperatureMin' => $weather['main']['temp_min'],
                'weatherIcon' => $weather['weather'][0]['icon'],
                'weatherIconPhrase' => $weather['weather'][0]['main'],
            ];
        }
        return $tenDaysOfWeatherDataList;
    }
    //切片，提高可读性
    function array_slice_with_step($array, $offset, $length, $step = 1, $preserve_keys = false)
    {
        $result = [];
        $count = 0;
        for ($i = $offset; $i < count($array) && $count < $length; $i += $step) {
            if ($preserve_keys) {
                $result[$i] = $array[$i];
            } else {
                $result[] = $array[$i];
            }
            $count++;
        }
        return $result;
    }

    //点赞功能
    public function likeIdea($id)
    {
        $idea = Idea::find($id);

        if (!$idea) {
            return response()->json(['error' => 'Idea not found'], 404);
        }

        $idea->favorites++;
        $idea->save();

        return response()->json(['success' => 'Idea liked successfully', 'data' => ['favorites' => $idea->favorites]]);
    }


}
