<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::with('sport')
            ->when($request->input('date_from') && $request->input('date_to'), function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->input('date_from'), $request->input('date_to')]);
            })
            ->when($request->input('sport_id'), function ($query) use ($request) {
                $query->where('sport_id', $request->input('sport_id'));
            })
            ->when($request->input('region_id'), function ($query) use ($request) {
                $query->where('region_id', $request->input('region_id'));
            })
            ->when($request->input('charity_id'), function ($query) use ($request) {
                $query->where('charity_id', $request->input('charity_id'));
            })
            ->paginate(9);

        return view('events', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['sport', 'region', 'charity']);

        return view('event', compact('event'));
    }
}
