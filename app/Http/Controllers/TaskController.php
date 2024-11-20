<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Territory;
use App\Models\TerritoryTask;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // All
        $tasks = Task::orderBy('id', 'desc')->paginate(10);
        $territoryTask = TerritoryTask::orderBy('id', 'desc')->paginate(10);
        $territoryTaskCount = count(TerritoryTask::orderBy('id', 'desc')->get());
        $categories = Category::all();
        $territories = Territory::all();

        // Two Days
        $endDate = Carbon::now()->addDays(2);

        $taskIds = Task::whereBetween('period', [Carbon::now(), $endDate])->pluck('id')->toArray();

        $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();

        $territoryTasksfortwo = TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $territoryTasksfortwoCount = count(TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')->get());

        // Tomorrow
        $tomorrowDate = Carbon::tomorrow();

        $territoryTasksforTomorrow = TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->orderBy('id', 'desc')->paginate(10);

        $territoryTasksforTomorrowCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->get());

        // Today
        $todayDate = Carbon::today();

        $territoryTasksForToday = TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->paginate(10);

        $territoryTasksForTodayCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->get());

        // Expired
        $expiredTasks = Task::whereDate('period', '<', Carbon::today())->get();

        $territoryTasksforExpired = TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')
            ->paginate(10);

        $territoryTasksforExpiredCount = count(TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')->get());


        return view('pages.task', [
            'models' => $territoryTask,
            'tasks' => $tasks,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTask,
            'territoryTaskCount' => $territoryTaskCount,
            'territoryTasksfortwoCount' => $territoryTasksfortwoCount,
            'territoryTasksforTomorrowCount' => $territoryTasksforTomorrowCount,
            'territoryTasksForTodayCount' => $territoryTasksForTodayCount,
            'territoryTasksforExpiredCount' => $territoryTasksforExpiredCount,



        ]);
    }
    public function two()
    {
        // Two Days
        $territoryTasks = TerritoryTask::orderBy('id', 'desc')->paginate(10);

        $endDate = Carbon::now()->addDays(2);

        $taskIds = Task::whereBetween('period', [Carbon::now(), $endDate])->pluck('id')->toArray();

        $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();

        $territoryTasksfortwo = TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $territoryTasksfortwoCount = count(TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')->get());

        $categories = Category::all();
        $territories = Territory::all();

        // All
        $territoryTask = TerritoryTask::orderBy('id', 'desc')->paginate(10);
        $territoryTaskCount = count(TerritoryTask::orderBy('id', 'desc')->get());

        // Tomorrow
        $tomorrowDate = Carbon::tomorrow();

        $territoryTasksforTomorrow = TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->orderBy('id', 'desc')->paginate(10);
        $territoryTasksforTomorrowCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->get());

        // Today
        $todayDate = Carbon::today();

        $territoryTasksForToday = TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->paginate(10);

        $territoryTasksForTodayCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->get());


        // Expired
        $expiredTasks = Task::whereDate('period', '<', Carbon::today())->get();

        $territoryTasksforExpired = TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')
            ->paginate(10);

        $territoryTasksforExpiredCount = count(TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')->get());
        return view('pages.task', [
            'models' => $territoryTasksfortwo,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasks,
            'territoryTaskCount' => $territoryTaskCount,
            'territoryTasksfortwoCount' => $territoryTasksfortwoCount,
            'territoryTasksforTomorrowCount' => $territoryTasksforTomorrowCount,
            'territoryTasksForTodayCount' => $territoryTasksForTodayCount,
            'territoryTasksforExpiredCount' => $territoryTasksforExpiredCount,


        ]);
    }

    public function tomorrow()
    {
        // Tomorrow
        $tomorrowDate = Carbon::tomorrow();

        $territoryTasksforTomorrow = TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->orderBy('id', 'desc')->paginate(10);
        $territoryTasksforTomorrowCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->get());

        $categories = Category::all();
        $territories = Territory::all();

        // All
        $territoryTask = TerritoryTask::orderBy('id', 'desc')->paginate(10);
        $territoryTaskCount = count(TerritoryTask::orderBy('id', 'desc')->get());

        // Two days
        $endDate = Carbon::now()->addDays(2);

        $taskIds = Task::whereBetween('period', [Carbon::now(), $endDate])->pluck('id')->toArray();

        $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();

        $territoryTasksfortwo = TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $territoryTasksfortwoCount = count(TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')->get());

        // Today
        $todayDate = Carbon::today();

        $territoryTasksForToday = TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->paginate(10);

        $territoryTasksForTodayCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->get());

        // Expired
        $expiredTasks = Task::whereDate('period', '<', Carbon::today())->get();

        $territoryTasksforExpired = TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')
            ->paginate(10);

        $territoryTasksforExpiredCount = count(TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')->get());

        return view('pages.task', [
            'models' => $territoryTasksforTomorrow,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasksforTomorrow,
            'territoryTaskCount' => $territoryTaskCount,
            'territoryTasksfortwoCount' => $territoryTasksfortwoCount,
            'territoryTasksforTomorrowCount' => $territoryTasksforTomorrowCount,
            'territoryTasksForTodayCount' => $territoryTasksForTodayCount,
            'territoryTasksforExpiredCount' => $territoryTasksforExpiredCount,


        ]);
    }
    public function today()
    {
        // Today
        $todayDate = Carbon::today();

        $territoryTasksForToday = TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->paginate(10);

        $territoryTasksForTodayCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->get());

        $categories = Category::all();
        $territories = Territory::all();

        // Tomorrow
        $tomorrowDate = Carbon::tomorrow();

        $territoryTasksforTomorrow = TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->orderBy('id', 'desc')->paginate(10);
        $territoryTasksforTomorrowCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->get());

        $categories = Category::all();
        $territories = Territory::all();

        // All
        $territoryTask = TerritoryTask::orderBy('id', 'desc')->paginate(10);
        $territoryTaskCount = count(TerritoryTask::orderBy('id', 'desc')->get());

        // Two days
        $endDate = Carbon::now()->addDays(2);

        $taskIds = Task::whereBetween('period', [Carbon::now(), $endDate])->pluck('id')->toArray();

        $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();

        $territoryTasksfortwo = TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $territoryTasksfortwoCount = count(TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')->get());

        // Expired
        $expiredTasks = Task::whereDate('period', '<', Carbon::today())->get();

        $territoryTasksforExpired = TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')
            ->paginate(10);

        $territoryTasksforExpiredCount = count(TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')->get());

        return view('pages.task', [
            'models' => $territoryTasksForToday,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasksForToday,
            'territoryTaskCount' => $territoryTaskCount,
            'territoryTasksfortwoCount' => $territoryTasksfortwoCount,
            'territoryTasksforTomorrowCount' => $territoryTasksforTomorrowCount,
            'territoryTasksForTodayCount' => $territoryTasksForTodayCount,
            'territoryTasksforExpiredCount' => $territoryTasksforExpiredCount,

        ]);
    }
    public function expired()
    {
        // Expired
        $expiredTasks = Task::whereDate('period', '<', Carbon::today())->get();

        $territoryTasksforExpired = TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')
            ->paginate(10);

        $territoryTasksforExpiredCount = count(TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')->get());

        $categories = Category::all();
        $territories = Territory::all();

        // Today
        $todayDate = Carbon::today();

        $territoryTasksForToday = TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->paginate(10);

        $territoryTasksForTodayCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->get());

        $categories = Category::all();
        $territories = Territory::all();

        // Tomorrow
        $tomorrowDate = Carbon::tomorrow();

        $territoryTasksforTomorrow = TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->orderBy('id', 'desc')->paginate(10);
        $territoryTasksforTomorrowCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->get());

        $categories = Category::all();
        $territories = Territory::all();

        // All
        $territoryTask = TerritoryTask::orderBy('id', 'desc')->paginate(10);
        $territoryTaskCount = count(TerritoryTask::orderBy('id', 'desc')->get());

        // Two days
        $endDate = Carbon::now()->addDays(2);

        $taskIds = Task::whereBetween('period', [Carbon::now(), $endDate])->pluck('id')->toArray();

        $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();
        $territoryTasksfortwoCount = count(TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')->get());

        return view('pages.task', [
            'models' => $territoryTasksforExpired,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasksforExpired,
            'territoryTaskCount' => $territoryTaskCount,
            'territoryTasksfortwoCount' => $territoryTasksfortwoCount,
            'territoryTasksforTomorrowCount' => $territoryTasksforTomorrowCount,
            'territoryTasksForTodayCount' => $territoryTasksForTodayCount,
            'territoryTasksforExpiredCount' => $territoryTasksforExpiredCount,
        ]);
    }
    public function indexUser()
    {
        $territoryIds = auth()->user()->territories->pluck('id');


        $territoryTasks = TerritoryTask::whereIn('territory_id', $territoryIds)
            ->orderBy('id', 'desc')
            ->paginate(10);

        $tasks = Task::orderBy('id', 'desc')->paginate(10);
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

        return redirect('/task')->with('warning', 'Ma\'lumot yangilandi!');
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
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $territoryTasks = TerritoryTask::orderBy('id', 'desc')->paginate(10);

        if ($start_date && $end_date) {
            $taskIds = Task::whereBetween('period', [$start_date, $end_date])->pluck('id')->toArray();

            $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();

            $territoryTasks = TerritoryTask::whereIn('id', $territoryTaskIds)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        $categories = Category::all();
        $territories = Territory::all();


        // Expired
        $expiredTasks = Task::whereDate('period', '<', Carbon::today())->get();

        $territoryTasksforExpired = TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')
            ->paginate(10);

        $territoryTasksforExpiredCount = count(TerritoryTask::whereIn('task_id', $expiredTasks->pluck('id')->toArray())
            ->orderBy('id', 'desc')->get());

        $categories = Category::all();
        $territories = Territory::all();

        // Today
        $todayDate = Carbon::today();

        $territoryTasksForToday = TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->paginate(10);

        $territoryTasksForTodayCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($todayDate) {
            $query->whereDate('period', $todayDate);
        })->orderBy('id', 'desc')->get());

        

        // Tomorrow
        $tomorrowDate = Carbon::tomorrow();

        $territoryTasksforTomorrow = TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->orderBy('id', 'desc')->paginate(10);
        $territoryTasksforTomorrowCount = count(TerritoryTask::whereHas('tasks', function ($query) use ($tomorrowDate) {
            $query->whereDate('period', $tomorrowDate);
        })->get());

        $categories = Category::all();
        $territories = Territory::all();

        // All
        $territoryTask = TerritoryTask::orderBy('id', 'desc')->paginate(10);
        $territoryTaskCount = count(TerritoryTask::orderBy('id', 'desc')->get());

        // Two days
        $endDate = Carbon::now()->addDays(2);

        $taskIds = Task::whereBetween('period', [Carbon::now(), $endDate])->pluck('id')->toArray();

        $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();
        $territoryTasksfortwoCount = count(TerritoryTask::whereIn('id', $territoryTaskIds)
            ->orderBy('id', 'desc')->get());
        return view('pages.task', [
            'models' => $territoryTasks,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasks,
            'territoryTaskCount' => $territoryTaskCount,
            'territoryTasksfortwoCount' => $territoryTasksfortwoCount,
            'territoryTasksforTomorrowCount' => $territoryTasksforTomorrowCount,
            'territoryTasksForTodayCount' => $territoryTasksForTodayCount,
            'territoryTasksforExpiredCount' => $territoryTasksforExpiredCount,
        ]);
    }

    public function filterUser(Request $request)
    {
        $territoryIds = auth()->user()->territories->pluck('id')->toArray();
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $territoryTasks = TerritoryTask::whereIn('territory_id', $territoryIds)
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($start_date && $end_date) {
            $taskIds = Task::whereBetween('period', [$start_date, $end_date])->pluck('id')->toArray();

            $territoryTaskIds = TerritoryTask::whereIn('task_id', $taskIds)->pluck('id')->toArray();

            $territoryTasks = TerritoryTask::whereIn('id', $territoryTaskIds)
                ->whereIn('territory_id', $territoryIds)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        $categories = Category::all();
        $territories = Territory::all();

        return view('pages.taskUser', [
            'models' => $territoryTasks,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasks
        ]);
    }

    public function accept(Request $request, TerritoryTask $task)
    {
        $acceptValue = $request->accept;
        $task->status = $acceptValue;
        $task->save();
        return redirect('/taskUser');
    }






}
