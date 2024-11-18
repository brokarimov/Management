<?php

namespace App\Http\Controllers;

use App\Models\Territory;
use App\Http\Controllers\Controller;
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
        return view('pages.territory', ['models' => $territories, 'users' => $users]);
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
        ]);
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
    public function update(Request $request, Territory $territory)
    {
        $request->validate([
            'name' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

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
}
