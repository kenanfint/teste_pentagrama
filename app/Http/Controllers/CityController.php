<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\FilterService;
use Illuminate\Http\RedirectResponse;

class CityController extends Controller
{
    private $objCity;
    private $pagination;

    public function __construct()
    {
        $this->objCity = new City();
        $this->pagination = $this->objCity->getPagination();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $cities = $this->objCity->paginate($this->pagination);
        return view('cities.index', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $city = new City();
        $city->name = $data['city_name'];
        $city->state = $data['state_name'];
        $city->foundation_date = $this->formatDate($data['foundation_date']);
        $city->save();

        $this->storeDistrict($city->id, $data['district_name']);

        return redirect()->route('cities.index')->with('status', 'Cidade cadastrada com sucesso.');
    }

    /**
     * Store a newly created district in storage,
     * with the foreign key "city_id"
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Void
     */
    public function storeDistrict(int $cityId, string $districtName): Void
    {
        $district = new District();
        $district->name = $districtName;
        $district->city_id = $cityId;
        $district->save();
    }

    /**
     * Filter cities.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function filter(Request $request): View
    {
        $filter = new FilterService();
        $cities = $filter->validateAndFilterFilledInputs($request);

        return view('cities.index', compact('cities'));
    }

    public function formatDate($date)
    {
        $fullDate = explode('/', $date);

        $day = $fullDate[0];
        $month   = $fullDate[1];
        $year  = $fullDate[2];

        if ($day <= 31 && $month <= 12) {
            return ($year . '-' . $month . '-' . $day);
        } else {
            abort(redirect()->route('cities.index')->with('session')->with('danger', 'Não foi possível cadastrar cidade, pois a Data de Fundação inválida'));
        }
    }
}
