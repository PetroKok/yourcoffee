<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityCreateRequest;
use App\Http\Requests\City\KitchenUpdateRequest;
use App\Http\Resources\Admin\CityResource;
use App\Models\City;
use App\Service\Interfaces\CityServiceInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public $cityService;

    public function __construct(CityServiceInterface $cityService)
    {
        $this->cityService = $cityService;
    }

    public function index(Request $request)
    {
        return view('admin.pages.index');
    }

    public function collection()
    {
        $data['meta']['title'] = trans('admin.menu.cities');
        $data['data'] = new CityResource($this->cityService->index());
        $data['fields'] = $this->cityService->fields();

        return response($data, 200);
    }

    public function create()
    {
        return view('admin.city.create');
    }

    public function store(CityCreateRequest $request)
    {
        $data = $request->validated();

        $this->cityService->store($data);

        return redirect()->route('admin::cities.index');
    }

    public function edit(City $city)
    {
        return view('admin.city.create', compact('city'));
    }

    public function update(CityCreateRequest $request, City $city)
    {
        $data = $request->validated();

        $this->cityService->update($data, $city);

        return redirect()->route('admin::cities.index');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return new CityResource($city);
    }
}
