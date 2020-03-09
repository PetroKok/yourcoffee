<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Label\LabelCreateRequest;
use App\Http\Requests\Label\LabelUpdateRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Resources\Admin\LabelResource;
use App\Models\Label;
use App\Service\LabelServiceInterface;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public $label;

    public function __construct(LabelServiceInterface $label)
    {
        $this->label = $label;
    }

    public function index()
    {
        return view('admin.pages.index');
    }

    public function collection()
    {
        $data['meta']['title'] = trans('admin.menu.labels');
        $data['data'] = new CategoryResource($this->label->index());
        $data['fields'] = $this->label->fields();
        return response($data, 200);
    }

    public function create()
    {
        return view('admin.label.create');
    }

    public function store(LabelCreateRequest $request)
    {
        $data = $request->all();

        $this->label->store($data);

        return redirect()->route('admin::label.index');
    }

    public function edit(Label $label)
    {
        return view('admin.label.create', compact('label'));
    }

    public function update(LabelUpdateRequest $request, Label $label)
    {
        $data = $request->all();

        $this->label->update($data, $label);

        return redirect()->route('admin::label.index');
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return new LabelResource($label);
    }
}
