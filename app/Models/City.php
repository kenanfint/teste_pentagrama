<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class City extends Model
{
    protected $fillable = [
        'name',
        'state',
        'foundation_date',
    ];

    use HasFactory;

    public function district()
    {
        return $this->hasOne(District::class);
    }

    public function filterAllConditions(Request $request, $data)
    {
        $formatteDate = $this->dateFormater($request->foundation_date);

        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->whereHas('district', function (Builder $query) use ($data) {
                $query->Where('name', 'LIKE', $data['district'] . "%");
            })
            ->where("foundation_date", "LIKE", "%{$formatteDate}%")->paginate(5);

        return $cities;
    }

    public function filterByCityAndFoundationDate(Request $request)
    {
        $formatteDate = $this->dateFormater($request->foundation_date);
        
        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->where("foundation_date", "LIKE", "%{$formatteDate}%")->paginate(5);

        return $cities;
    }

    public function filterByNameAndDistrict(Request $request, $data)
    {
        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->whereHas('district', function (Builder $query) use ($data) {
                $query->Where('name', 'LIKE', $data['district'] . "%");
            })->paginate(5);

        return $cities;
    }

    public function filterByFoundationDateAndDistrict(Request $request, $data)
    {
        $formatteDate = $this->dateFormater($request->foundation_date);

        $cities = City::where("foundation_date", "LIKE", "%{$formatteDate}%")
            ->whereHas('district', function (Builder $query) use ($data) {
                $query->Where('name', 'LIKE', $data['district'] . "%");
            })->paginate(5);

        return $cities;
    }

    public function filterByCityName(Request $request)
    {
        $cities = City::where("name", "LIKE", "%{$request->city_name}%")->paginate(5);

        return $cities;
    }

    public function filterByFoundationDate(Request $request)
    {
        $formatteDate = $this->dateFormater($request->foundation_date);
        $cities = City::where("foundation_date", "LIKE", "%{$formatteDate}%")->paginate(5);

        return $cities;
    }

    public function filterByDistrict($data)
    {
        $cities = City::whereHas('district', function (Builder $query) use ($data) {
            $query->Where('name', 'LIKE', $data['district'] . "%");
        })->paginate(5);

        return $cities;
    }

    public function dateFormater($date)
    {
        $orderdate = explode('/', $date);
        $day = $orderdate[0];
        $month   = $orderdate[1];
        $year  = $orderdate[2];

        return ($year . '-' . $month . '-' . $day);
    }
}
