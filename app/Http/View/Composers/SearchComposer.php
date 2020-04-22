<?php

namespace App\Http\View\Composers;

use App\Charity;
use App\Region;
use App\Sport;
use Illuminate\View\View;

class SearchComposer
{
    public function compose(View $view)
    {
        $view->with([
            'searchSports' => Sport::pluck('name', 'id'),
            'searchRegions' => Region::pluck('name', 'id'),
            'searchCharities' => Charity::pluck('name', 'id'),
        ]);
    }
}
