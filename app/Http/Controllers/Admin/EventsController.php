<?php

namespace App\Http\Controllers\Admin;

use App\Charity;
use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Region;
use App\Sport;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sports = Sport::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $regions = Region::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charities = Charity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.events.create', compact('sports', 'regions', 'charities'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());

        if ($request->input('photo', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('admin.events.index');

    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sports = Sport::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $regions = Region::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charities = Charity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event->load('sport', 'region', 'charity', 'created_by');

        return view('admin.events.edit', compact('sports', 'regions', 'charities', 'event'));
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

        return redirect()->route('admin.events.index');

    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('sport', 'region', 'charity', 'created_by');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();

    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Event::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }

}
