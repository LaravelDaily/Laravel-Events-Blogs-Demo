<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\Admin\EventResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventResource(Event::with(['sport', 'region', 'charity', 'created_by'])->get());

    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());

        if ($request->input('photo', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventResource($event->load(['sport', 'region', 'charity', 'created_by']));

    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

        if ($request->input('photo', false)) {
            if (!$event->photo || $request->input('photo') !== $event->photo->file_name) {
                $event->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($event->photo) {
            $event->photo->delete();
        }

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
