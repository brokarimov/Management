<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\TerritoryTask;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(10);

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.category', ['models' => $categories, 'AlertCount' => $AlertCount]);
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
        Category::create($data);

        return redirect('/category')->with('success', 'Ma\'lumot qo\'shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);

        return redirect('/category')->with('warning', 'Ma\'lumot yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/category')->with('danger', 'Ma\'lumot o\'chirildi!');
    }


    public function search(Request $request)
    {
        $models = Category::where('name', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(10);

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.category', ['models' => $models, 'AlertCount' => $AlertCount]);
    }
}
