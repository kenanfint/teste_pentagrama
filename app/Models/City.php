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
        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->whereHas('district', function (Builder $query) use ($data) {
                $query->Where('name', 'LIKE', $data['district'] . "%");
            })
            ->where("foundation_date", "LIKE", "%{$request->foundation_date}%")->paginate(5);

        return $cities;
    }

    public function filterByCityAndFoundationDate(Request $request, $data)
    {
        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->where("foundation_date", "LIKE", "%{$request->foundation_date}%")->paginate(5);

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
        $cities = City::where("foundation_date", "LIKE", "%{$request->foundation_date}%")
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
        $cities = City::where("foundation_date", "LIKE", "%{$request->foundation_date}%")->paginate(5);

        return $cities;
    }

    public function filterByDistrict($data)
    {
        $cities = City::whereHas('district', function (Builder $query) use ($data) {
            $query->Where('name', 'LIKE', $data['district'] . "%");
        })->paginate(5);

        return $cities;
    }
}
