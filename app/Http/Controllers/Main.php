<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TerritoryTask;
use Illuminate\Http\Request;

class Main extends Controller
{
    public function main()
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
            $AlertCount = TerritoryTask::where('status', 3)->count();
            return view('layouts.main', ['AlertCount' => $AlertCount]);
        }
        return view('layouts.main');
    }
}
