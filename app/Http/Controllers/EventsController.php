<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::when($request->input('sport_id'), function ($query) use ($request) {
                $query->where('sport_id', $request->input('sport_id'));
            })
            ->get();

        return view('events', compact('events'));
    }

    public function show(Event $event)
    {
        return view('event', compact('event'));
    }
}
