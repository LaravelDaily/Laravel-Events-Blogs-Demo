<?php

namespace App\Http\Controllers;

use App\Charity;
use App\Post;
use App\Region;
use App\Sport;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $popularSports = Sport::withCount('events')
            ->orderBy('events_count', 'desc')
            ->take(5)
            ->pluck('name', 'id');
        $blogPosts     = Post::latest()->take(3)->get();
        $allSports     = Sport::with(['events' => function ($query) {
                $query->where('start_time', '>', now())->orderBy('start_time', 'asc')->get();
            }])
            ->get();

        return view('home', compact('popularSports', 'allSports', 'blogPosts'));
    }
}
