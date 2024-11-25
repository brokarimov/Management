<?php

namespace App\Http\Controllers;

use App\Http\Requests\Territory\StoreRequest;
use App\Http\Requests\Territory\UpdateRequest;
use App\Models\Territory;
use App\Http\Controllers\Controller;
use App\Models\TerritoryTask;
use App\Models\User;
use Illuminate\Http\Request;

class TerritoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $territories = Territory::orderBy('id', 'asc')->paginate(10);

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.territory', ['models' => $territories, 'users' => $users, 'AlertCount' => $AlertCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        Territory::create($data);
        return redirect('/territory')->with('success', 'Ma\'lumot qo\'shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Territory $territory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Territory $territory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Territory $territory)
    {
        $data = $request->all();

        $territory->update($data);
        return redirect('/territory')->with('warning', 'Ma\'lumot yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Territory $territory)
    {
        $territory->delete();
        return redirect('/territory')->with('danger', 'Ma\'lumot o\'chirildi!');
    }
    public function search(Request $request)
    {
        $users = User::all();
        $models = Territory::where('name', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(10);

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.territory', ['models' => $models, 'users' => $users, 'AlertCount' => $AlertCount]);
    }
}
