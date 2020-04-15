<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Charity;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCharityRequest;
use App\Http\Requests\UpdateCharityRequest;
use App\Http\Resources\Admin\CharityResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CharitiesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('charity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CharityResource(Charity::all());

    }

    public function store(StoreCharityRequest $request)
    {
        $charity = Charity::create($request->all());

        return (new CharityResource($charity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Charity $charity)
    {
        abort_if(Gate::denies('charity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CharityResource($charity);

    }

    public function update(UpdateCharityRequest $request, Charity $charity)
    {
        $charity->update($request->all());

        return (new CharityResource($charity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Charity $charity)
    {
        abort_if(Gate::denies('charity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $charity->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
