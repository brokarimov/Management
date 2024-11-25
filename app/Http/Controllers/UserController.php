<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\TerritoryTask;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.user', ['models' => $users, 'AlertCount' => $AlertCount]);
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
        User::create($data);

        return redirect('/user')->with('success', 'Ma\'lumot qo\'shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->all();
        $user->update($data);

        return redirect('/user')->with('warning', 'Ma\'lumot yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/user')->with('danger', 'Ma\'lumot o\'chirildi!');
    }

    public function search(Request $request)
    {
        $models = User::where('name', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(10);
        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.user', ['models' => $models, 'AlertCount' => $AlertCount]);
    }
}
