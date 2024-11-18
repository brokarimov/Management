<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Territory;
use App\Models\TerritoryTask;
use DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'asc')->paginate(10);
        $territoryTask = TerritoryTask::orderBy('id', 'asc')->paginate(10);
        $categories = Category::all();
        $territories = Territory::all();
        return view('pages.task', ['models' => $territoryTask, 'tasks' => $tasks, 'categories' => $categories, 'territories' => $territories, 'territoryTasks' => $territoryTask]);
    }
    public function indexUser()
    {
        $territoryIds = auth()->user()->territories->pluck('id');  

        
        $territoryTasks = TerritoryTask::whereIn('territory_id', $territoryIds)
            ->orderBy('id', 'asc')
            ->paginate(10); 

        $tasks = Task::orderBy('id', 'asc')->paginate(10);
        $categories = Category::all();
        $territories = Territory::all();

        return view('pages.taskUser', [
            'models' => $territoryTasks,
            'tasks' => $tasks,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasks
        ]);
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
            'category_id' => 'required|exists:categories,id',
            'territory_id' => 'required|array',
            'territory_id.*' => 'exists:territories,id',
            'employee' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf',
            'period' => 'required',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            if ($extension !== 'pdf') {
                return redirect()->back()->with('danger', 'File must be in PDF format.');
            }

            $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
            $file->move('pdf_upload/', $filename);
            $filePath = 'pdf_upload/' . $filename;
        }

        $newTask = new Task();
        $newTask->category_id = $request->category_id;
        $newTask->employee = $request->employee;
        $newTask->title = $request->title;
        $newTask->description = $request->description;
        $newTask->file = $filePath;
        $newTask->period = $request->period;

        $newTask->save();

        foreach ($request->territory_id as $territory) {
            TerritoryTask::create([
                'territory_id' => $territory,
                'task_id' => $newTask->id,
            ]);
        }

        return redirect('/task')->with('success', 'Ma\'lumot qo\'shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, TerritoryTask $task)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'territory_id' => 'required|array',
            'territory_id.*' => 'exists:territories,id',
            'employee' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf',
            'period' => 'required',
        ]);

        // Find the task by ID
        $taskID = Task::where('id', $task->task_id)->first();
        $taskID->employee = $validated['employee'];
        $taskID->title = $validated['title'];
        $taskID->description = $validated['description'];
        $taskID->period = $validated['period'];
        $taskID->category_id = $validated['category_id'];

        // Handle the uploaded file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            if ($extension !== 'pdf') {
                return redirect()->back()->with('danger', 'File must be in PDF format.');
            }

            $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
            $file->move('pdf_upload/', $filename);
            $filePath = 'pdf_upload/' . $filename;
            $taskID->file = $filePath;
        }

        $taskID->save();

        if ($request->has('territory_id')) {
            $existingTerritoryIds = $taskID->territories->pluck('id')->toArray();

            $newTerritoryIds = array_diff($validated['territory_id'], $existingTerritoryIds);

            foreach ($newTerritoryIds as $territoryId) {
                $taskID->territories()->attach($territoryId, [
                    'created_at' => now(),
                ]);
            }

        }

        return redirect('/task')->with('success', 'Task updated successfully');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TerritoryTask $task)
    {
        $task->delete();
        return redirect('/task')->with('danger', 'Ma\'lumot o\'chirildi!');
    }

    public function filter(Request $request)
    {
        // dd($request->all());
        // $territoryTask = TerritoryTask::orderBy('id', 'asc')->paginate(10);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ($start_date && $end_date) {
            $territoryTask = TerritoryTask::whereBetween('created_at', [$start_date, $end_date])
                ->orderBy('id', 'asc')
                ->paginate(10);
        } else {
            $territoryTask = TerritoryTask::orderBy('id', 'asc')->paginate(10);
        }


        $categories = Category::all();
        $territories = Territory::all();

        return view('pages.task', ['models' => $territoryTask, 'categories' => $categories, 'territories' => $territories]);
    }

    public function filterUser(Request $request)
    {
        // dd($request->all());
        // $territoryTask = TerritoryTask::orderBy('id', 'asc')->paginate(10);
        $territoryIds = auth()->user()->territories->pluck('id');  
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ($start_date && $end_date) {
            $territoryTask = TerritoryTask::whereIn('territory_id', $territoryIds)->whereBetween('created_at', [$start_date, $end_date])
                ->orderBy('id', 'asc')
                ->paginate(10);
        } else {
            $territoryTask = TerritoryTask::whereIn('territory_id', $territoryIds)->orderBy('id', 'asc')->paginate(10);
        }


        $categories = Category::all();
        $territories = Territory::all();

        return view('pages.taskUser', ['models' => $territoryTask, 'categories' => $categories, 'territories' => $territories]);
    }
}
