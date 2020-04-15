<?php

namespace App\Http\Controllers\Admin;

use App\Charity;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCharityRequest;
use App\Http\Requests\StoreCharityRequest;
use App\Http\Requests\UpdateCharityRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CharitiesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('charity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $charities = Charity::all();

        return view('admin.charities.index', compact('charities'));
    }

    public function create()
    {
        abort_if(Gate::denies('charity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.charities.create');
    }

    public function store(StoreCharityRequest $request)
    {
        $charity = Charity::create($request->all());

        return redirect()->route('admin.charities.index');

    }

    public function edit(Charity $charity)
    {
        abort_if(Gate::denies('charity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.charities.edit', compact('charity'));
    }

    public function update(UpdateCharityRequest $request, Charity $charity)
    {
        $charity->update($request->all());

        return redirect()->route('admin.charities.index');

    }

    public function show(Charity $charity)
    {
        abort_if(Gate::denies('charity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.charities.show', compact('charity'));
    }

    public function destroy(Charity $charity)
    {
        abort_if(Gate::denies('charity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $charity->delete();

        return back();

    }

    public function massDestroy(MassDestroyCharityRequest $request)
    {
        Charity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
