<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSportRequest;
use App\Http\Requests\UpdateSportRequest;
use App\Http\Resources\Admin\SportResource;
use App\Sport;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SportsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sport_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SportResource(Sport::all());

    }

    public function store(StoreSportRequest $request)
    {
        $sport = Sport::create($request->all());

        return (new SportResource($sport))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Sport $sport)
    {
        abort_if(Gate::denies('sport_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SportResource($sport);

    }

    public function update(UpdateSportRequest $request, Sport $sport)
    {
        $sport->update($request->all());

        return (new SportResource($sport))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Sport $sport)
    {
        abort_if(Gate::denies('sport_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sport->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
