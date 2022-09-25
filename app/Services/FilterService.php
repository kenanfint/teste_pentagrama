<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class FilterService
{
    protected $objCity;
    protected $pagination;

    public function __construct()
    {
        $this->objCity = new City();
        $this->pagination = $this->objCity->getPagination();
    }

    /**
     * Get the search inputs and validate which one
     * the user filled, then filter by them;
     * 
     * @param  \Illuminate\Http\Request  $request;
     * @return \Illuminate\Pagination\LengthAwarePaginator | \Illuminate\Http\RedirectResponse; 
     */
    public function validateAndFilterFilledInputs(Request $request): LengthAwarePaginator
    {
        $data = $request->all();

        if (!empty($data['city_name']) && !empty($data['foundation_date']) &&  !empty($data['district'])) {
            $cities = $this->filterAllConditions($request);
        } elseif (!empty($data['city_name']) && !empty($data['foundation_date'])) {
            $cities = $this->filterByCityAndFoundationDate($request);
        } elseif (!empty($data['city_name']) &&  !empty($data['district'])) {
            $cities = $this->filterByNameAndDistrict($request);
        } elseif (!empty($data['foundation_date']) && !empty($data['district'])) {
            $cities = $this->filterByFoundationDateAndDistrict($request);
        } elseif (!empty($data['city_name'])) {
            $cities = $this->filterByCityName($request);
        } elseif (!empty($data['foundation_date'])) {
            $cities = $this->filterByFoundationDate($request);
        } elseif (!empty($data['district'])) {
            $cities = $this->filterByDistrict($request);
        } else {
            $cities = $this->objCity->paginate($this->pagination);
        }

        return $cities;
    }

    /**
     * Filter cities by name, district and foundation date.
     * 
     * @param  \Illuminate\Http\Request  $request;
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function filterAllConditions(Request $request): LengthAwarePaginator
    {
        $formatteDate = $this->dateFormater($request->foundation_date);

        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->whereHas('district', function (Builder $query) use ($request) {
                $query->Where('name', 'LIKE', $request->district . "%");
            })
            ->where("foundation_date", "LIKE", "%{$formatteDate}%")->paginate($this->pagination);

        return $cities;
    }

    /**
     * Filter cities by name and foundation date.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function filterByCityAndFoundationDate(Request $request): LengthAwarePaginator
    {
        $formatteDate = $this->dateFormater($request->foundation_date);

        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->where("foundation_date", "LIKE", "%{$formatteDate}%")->paginate($this->pagination);

        return $cities;
    }

    /**
     * Filter cities by name and district.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function filterByNameAndDistrict(Request $request): LengthAwarePaginator
    {
        $cities = City::where("name", "LIKE", "%{$request->city_name}%")
            ->whereHas('district', function (Builder $query) use ($request) {
                $query->Where('name', 'LIKE', $request->district . "%");
            })->paginate($this->pagination);

        return $cities;
    }

    /**
     * Filter cities by foundation date and district.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function filterByFoundationDateAndDistrict(Request $request): LengthAwarePaginator
    {
        $formatteDate = $this->dateFormater($request->foundation_date);

        $cities = City::where("foundation_date", "LIKE", "%{$formatteDate}%")
            ->whereHas('district', function (Builder $query) use ($request) {
                $query->Where('name', 'LIKE', $request->district . "%");
            })->paginate($this->pagination);

        return $cities;
    }

    /**
     * Filter cities by city name.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function filterByCityName(Request $request): LengthAwarePaginator
    {
        $cities = City::where("name", "LIKE", "%{$request->city_name}%")->paginate($this->pagination);

        return $cities;
    }

    /**
     * Filter cities by foundation date.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function filterByFoundationDate(Request $request): LengthAwarePaginator
    {
        $formatteDate = $this->dateFormater($request->foundation_date);
        $cities = City::where("foundation_date", "LIKE", "%{$formatteDate}%")->paginate($this->pagination);

        return $cities;
    }

    /**
     * Filter cities by district.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Pagination\LengthAwarePaginator;
     */
    public function filterByDistrict(Request $request): LengthAwarePaginator
    {
        $cities = City::whereHas('district', function (Builder $query) use ($request) {
            $query->Where('name', 'LIKE', $request->district . "%");
        })->paginate($this->pagination);

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
