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
        $popularSports   = Sport::pluck('name', 'id');
        $searchRegions   = Region::pluck('name', 'id');
        $searchCharities = Charity::pluck('name', 'id');
        $blogPosts       = Post::latest()->take(3)->get();
        $allSports       = Sport::with(['events' => function ($query) {
                $query->where('start_time', '>', now())->orderBy('start_time', 'asc')->take(5);
            }])
            ->get();

        return view('home', compact('popularSports', 'searchRegions', 'searchCharities', 'allSports', 'blogPosts'));
    }
}
