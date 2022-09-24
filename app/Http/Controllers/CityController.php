<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $objCity;

    public function __construct()
    {
        $this->objCity = new City();
    }

    public function index()
    {
        $cities = $this->objCity->paginate(5);
        return view('cities.index', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $city = new City();
        $city->name = $data['city_name'];
        $city->state = $data['state_name'];
        $city->foundation_date = $data['foundation_date'];
        $city->save();

        $district = new District();
        $district->name = $data['district_name'];
        $district->city_id = $city->id;
        $district->save();

        return redirect()->route('cities.index');
    }

    public function validateFilterType(Request $request)
    {
        $data = $request->all();

        if ($data['city_name'] != null && $data['foundation_date'] != null && $data['district'] != null) {
            //filter by ALL conditions
            $cities = $this->objCity->filterAllConditions($request, $data);
        } elseif ($data['city_name'] != null && $data['foundation_date']) {
            //filter by city name and foundation date
            $cities = $this->objCity->filterByCityAndFoundationDate($request, $data);
        } elseif ($data['city_name'] != null && $data['district'] != null) {
            //filter by city name and district
            $cities = $this->objCity->filterByNameAndDistrict($request, $data);
        } elseif ($data['foundation_date'] != null && $data['district'] != null) {
            //filter by foundation date and district
            $cities = $this->objCity->filterByFoundationDateAndDistrict($request, $data);
        } elseif ($data['city_name'] != null) {
            //filter JUST by city name
            $cities = $this->objCity->filterByCityName($request, $data);
        } elseif ($data['foundation_date'] != null) {
            //filter JUST by foundation date
            $cities = $this->objCity->filterByFoundationDate($request, $data);
        } elseif ($data['district'] != null) {
            $cities = $this->objCity->filterByDistrict($request, $data);
        }

        return view('cities.index', compact('cities'));
    }
}
