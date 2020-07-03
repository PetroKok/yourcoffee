<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kitchen\KitchenCreateRequest;
use App\Http\Requests\Kitchen\KitchenUpdateRequest;
use App\Http\Resources\Admin\KitchenResource;
use App\Models\Kitchen;
use App\Service\Interfaces\CityServiceInterface;
use App\Service\Interfaces\KitchenServiceInterface;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public $kitchenService;
    public $cityService;

    public function __construct(KitchenServiceInterface $kitchenService, CityServiceInterface $cityService)
    {
        $this->kitchenService = $kitchenService;
        $this->cityService = $cityService;
    }

    public function index(Request $request)
    {
        return view('admin.pages.index');
    }

    public function collection()
    {
        $data['meta']['title'] = trans('admin.menu.kitchens');
        $data['data'] = new kitchenResource($this->kitchenService->index());
        $data['fields'] = $this->kitchenService->fields();
        return response($data, 200);
    }

    public function create()
    {
        $cities = $this->cityService->indexPluck();
        return view('admin.kitchen.create', compact('cities'));
    }

    public function store(KitchenCreateRequest $request)
    {
        $data = $request->validated();

        $this->kitchenService->store($data);

        return redirect()->route('admin::kitchens.index');
    }

    public function edit(Kitchen $kitchen)
    {
        $cities = $this->cityService->indexPluck();
        $kitchen->load('cities');
        return view('admin.kitchen.create', compact('kitchen', 'cities'));
    }

    public function update(KitchenUpdateRequest $request, kitchen $kitchen)
    {
        $data = $request->validated();

        $this->kitchenService->update($data, $kitchen);

        return redirect()->route('admin::kitchens.index');
    }

    public function destroy($id)
    {
        $kitchen = Kitchen::findOrFail($id);
        $kitchen->delete();
        return new KitchenResource($kitchen);
    }
}
