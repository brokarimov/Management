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
    public function index(int $status)
    {
        $territorytasks = collect();

        switch ($status) {
            case 1:
                $territorytasks = TerritoryTask::orderBy('id', 'desc')->paginate(10);
                break;
            case 2:
                $exactDate = Carbon::now()->addDays(2)->startOfDay();
                $territorytasks = TerritoryTask::whereDate('period', $exactDate)->orderBy('id', 'desc')->paginate(10);
                break;
            case 3:
                $exactDate = Carbon::tomorrow()->startOfDay();
                $territorytasks = TerritoryTask::whereDate('period', $exactDate)->orderBy('id', 'desc')->paginate(10);
                break;
            case 4:
                $exactDate = Carbon::today()->startOfDay();
                $territorytasks = TerritoryTask::whereDate('period', $exactDate)->orderBy('id', 'desc')->paginate(10);
                break;
            case 5:
                $exactDate = Carbon::today()->startOfDay();
                $territorytasks = TerritoryTask::whereDate('period', '<', $exactDate)->orderBy('id', 'desc')->paginate(10);
                break;
            case 6:
                $territorytasks = TerritoryTask::where('status', 4)->orderBy('id', 'desc')->paginate(10);
                break;
            default:
                $territorytasks = TerritoryTask::orderBy('id', 'desc')->paginate(10);
                break;
        }

        $countAll = TerritoryTask::count();
        $countTwo = TerritoryTask::whereDate('period', Carbon::now()->addDays(2)->startOfDay())->count();
        $countTomorrow = TerritoryTask::whereDate('period', Carbon::tomorrow()->startOfDay())->count();
        $countToday = TerritoryTask::whereDate('period', Carbon::today()->startOfDay())->count();
        $countExpired = TerritoryTask::whereDate('period', '<', Carbon::today()->startOfDay())->count();
        $countAccepted = TerritoryTask::where('status', 4)->count();

        $categories = Category::all();
        $territories = Territory::all();

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.task', [
            'models' => $territorytasks,
            'territoryTasks' => $territorytasks,
            'categories' => $categories,
            'territories' => $territories,
            'countAll' => $countAll,
            'countTwo' => $countTwo,
            'countTomorrow' => $countTomorrow,
            'countToday' => $countToday,
            'countExpired' => $countExpired,
            'countAccepted' => $countAccepted,
            'AlertCount' => $AlertCount
        ]);
    }




    public function indexUser(int $status)
    {
        $territoryIds = auth()->user()->territories->pluck('id');


        $territorytasksQuery = TerritoryTask::whereIn('territory_id', $territoryIds)->orderBy('id', 'desc');


        $categories = Category::all();
        $territories = Territory::all();



        if ($status == 1) {
            $territorytasks = $territorytasksQuery->paginate(10);
        } elseif ($status == 2) {
            $exactDate = Carbon::now()->addDays(2)->startOfDay();
            $territorytasks = $territorytasksQuery->whereDate('period', $exactDate)->paginate(10);
        } elseif ($status == 3) {
            $exactDate = Carbon::tomorrow()->startOfDay();
            $territorytasks = $territorytasksQuery->whereDate('period', $exactDate)->paginate(10);
        } elseif ($status == 4) {
            $exactDate = Carbon::today()->startOfDay();
            $territorytasks = $territorytasksQuery->whereDate('period', $exactDate)->where('status', 4)->paginate(10);
        } elseif ($status == 5) {
            $exactDate = Carbon::today()->startOfDay();
            $territorytasks = $territorytasksQuery->whereDate('period', '<', $exactDate)->paginate(10);
        }


        $countAll = TerritoryTask::whereIn('territory_id', $territoryIds)->count();
        $countTwo = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', Carbon::now()->addDays(2)->startOfDay())->count();
        $countTomorrow = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', Carbon::tomorrow()->startOfDay())->count();
        $countToday = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', Carbon::today()->startOfDay())->count();
        $countExpired = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', '<', Carbon::today()->startOfDay())->count();
        $countAccepted = TerritoryTask::whereIn('territory_id', $territoryIds)->where('status', 4)->count();

        return view('pages.taskUser', [
            'models' => $territorytasks,
            'territorytasks' => $territorytasks,
            'categories' => $categories,
            'territories' => $territories,
            'countAll' => $countAll,
            'countTwo' => $countTwo,
            'countTomorrow' => $countTomorrow,
            'countToday' => $countToday,
            'countExpired' => $countExpired,
            'countAccepted' => $countAccepted,

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
        ], [
            'category_id.required' => 'Category is required.',
            'territory_id.required' => 'At least one territory must be selected.',
            'file.mimes' => 'Only PDF files are allowed.',
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
            $data['file'] = $filePath;
        }

        $newTask = Task::create([
            'category_id' => $request->category_id,
            'employee' => $request->employee,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filePath,
            'period' => $request->period,
        ]);

        // Attach territories to the task
        foreach ($request->territory_id as $territory) {
            TerritoryTask::create([
                'territory_id' => $territory,
                'task_id' => $newTask->id,
                'category_id' => $request->category_id,
                'period' => $request->period,
            ]);
        }

        return redirect('/task/1')->with('success', 'Ma\'lumot qo\'shildi!');
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

        $taskID = Task::where('id', $task->task_id)->first();
        $taskID->employee = $validated['employee'];
        $taskID->title = $validated['title'];
        $taskID->description = $validated['description'];
        $taskID->period = $validated['period'];
        $taskID->category_id = $validated['category_id'];

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

        return redirect('/task/1')->with('warning', 'Ma\'lumot yangilandi!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TerritoryTask $task)
    {
        $task->delete();
        return redirect('/task/1')->with('danger', 'Ma\'lumot o\'chirildi!');
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

        $countAll = TerritoryTask::all()->count();
        $countTwo = TerritoryTask::whereDate('period', Carbon::now()->addDays(2)->startOfDay())->count();
        $countTomorrow = TerritoryTask::whereDate('period', Carbon::tomorrow()->startOfDay())->count();
        $countToday = TerritoryTask::whereDate('period', Carbon::today()->startOfDay())->count();
        $countExpired = TerritoryTask::whereDate('period', '<', Carbon::today()->startOfDay())->count();
        $countAccepted = TerritoryTask::where('status', 4)->count();

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.task', [
            'models' => $territoryTasks,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasks,
            'countAll' => $countAll,
            'countTwo' => $countTwo,
            'countTomorrow' => $countTomorrow,
            'countToday' => $countToday,
            'countExpired' => $countExpired,
            'countAccepted' => $countAccepted,
            'AlertCount' => $AlertCount
        ]);
    }

    public function filterUser(Request $request)
    {
        $territoryIds = auth()->user()->territories->pluck('id')->toArray();

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $territoryTasksQuery = TerritoryTask::whereIn('territory_id', $territoryIds)
            ->orderBy('id', 'desc');

        if ($start_date && $end_date) {
            $territoryTasksQuery->whereHas('tasks', function ($query) use ($start_date, $end_date) {
                $query->whereBetween('period', [$start_date, $end_date]);
            });
        }

        $territoryTasks = $territoryTasksQuery->paginate(10);

        $categories = Category::all();
        $territories = Territory::all();

        $countAll = TerritoryTask::whereIn('territory_id', $territoryIds)->count();
        $countTwo = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', Carbon::now()->addDays(2)->startOfDay())->count();
        $countTomorrow = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', Carbon::tomorrow()->startOfDay())->count();
        $countToday = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', Carbon::today()->startOfDay())->count();
        $countExpired = TerritoryTask::whereIn('territory_id', $territoryIds)->whereDate('period', '<', Carbon::today()->startOfDay())->count();
        $countAccepted = TerritoryTask::whereIn('territory_id', $territoryIds)->where('status', 4)->count();

        return view('pages.taskUser', [
            'models' => $territoryTasks,
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasks,
            'countAll' => $countAll,
            'countTwo' => $countTwo,
            'countTomorrow' => $countTomorrow,
            'countToday' => $countToday,
            'countExpired' => $countExpired,
            'countAccepted' => $countAccepted
        ]);
    }


    public function accept(Request $request, TerritoryTask $task)
    {
        $acceptValue = $request->accept;
        $task->status = $acceptValue;
        $task->save();
        return redirect('/taskUser/1');
    }


    public function management(int $status)
    {
        $territorytasks = collect();
        $btnColor = 'info';
        $array = [1, 2, 3, 4, 5, 6];
        if (in_array($status, $array)) {
            switch ($status) {
                case 1:
                    $territorytasks = TerritoryTask::all();
                    $btnColor = 'info';
                    break;
                case 2:
                    $exactDate = Carbon::now()->addDays(2)->startOfDay();
                    $territorytasks = TerritoryTask::whereDate('period', $exactDate)->get();
                    $btnColor = 'warning';
                    break;
                case 3:
                    $exactDate = Carbon::tomorrow()->startOfDay();
                    $territorytasks = TerritoryTask::whereDate('period', $exactDate)->get();
                    $btnColor = 'primary';
                    break;
                case 4:
                    $exactDate = Carbon::today()->startOfDay();
                    $territorytasks = TerritoryTask::whereDate('period', $exactDate)->get();
                    $btnColor = 'success';
                    break;
                case 5:
                    $exactDate = Carbon::today()->startOfDay();
                    $territorytasks = TerritoryTask::whereDate('period', '<', $exactDate)->get();
                    $btnColor = 'danger';
                    break;
                case 6:
                    $territorytasks = TerritoryTask::where('status', 4)->get();
                    $btnColor = 'success';
                    break;
                default:
                    break;
            }
        } else {
            abort(403);
        }


        $countAll = TerritoryTask::count();
        $countTwo = TerritoryTask::whereDate('period', Carbon::now()->addDays(2)->startOfDay())->count();
        $countTomorrow = TerritoryTask::whereDate('period', Carbon::tomorrow()->startOfDay())->count();
        $countToday = TerritoryTask::whereDate('period', Carbon::today()->startOfDay())->count();
        $countExpired = TerritoryTask::whereDate('period', '<', Carbon::today()->startOfDay())->count();
        $countAccepted = TerritoryTask::where('status', 4)->count();

        $categories = Category::all();
        $territories = Territory::all();

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.management', [
            'models' => $territorytasks,
            'categories' => $categories,
            'territories' => $territories,
            'btnColor' => $btnColor,
            'countAll' => $countAll,
            'countTwo' => $countTwo,
            'countTomorrow' => $countTomorrow,
            'countToday' => $countToday,
            'countExpired' => $countExpired,
            'countAccepted' => $countAccepted,
            'AlertCount' => $AlertCount
        ]);
    }

    public function onetask(Request $request)
    {
        $territory_task = TerritoryTask::where('category_id', $request->category_id)->where('territory_id', $request->territory_id)->get();

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.onetask', ['models' => $territory_task, 'AlertCount' => $AlertCount]);
    }

    public function report1()
    {
        $territorytasks = TerritoryTask::all();
        $countAll = TerritoryTask::count();
        $countTwo = TerritoryTask::whereDate('period', Carbon::now()->addDays(2)->startOfDay())->count();
        $countTomorrow = TerritoryTask::whereDate('period', Carbon::tomorrow()->startOfDay())->count();
        $countToday = TerritoryTask::whereDate('period', Carbon::today()->startOfDay())->count();
        $countExpired = TerritoryTask::whereDate('period', '<', Carbon::today()->startOfDay())->count();
        $countAccepted = TerritoryTask::where('status', 4)->count();

        $categories = Category::all();
        $territories = Territory::all();

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.report1', [
            'models' => $territorytasks,
            'territoryTasks' => $territorytasks,
            'categories' => $categories,
            'territories' => $territories,
            'countAll' => $countAll,
            'countTwo' => $countTwo,
            'countTomorrow' => $countTomorrow,
            'countToday' => $countToday,
            'countExpired' => $countExpired,
            'countAccepted' => $countAccepted,
            'AlertCount' => $AlertCount
        ]);

    }

    public function report2()
    {
        $territorytasks = TerritoryTask::all();
        $countAll = TerritoryTask::count();
        $countTwo = TerritoryTask::whereDate('period', Carbon::now()->addDays(2)->startOfDay())->count();
        $countTomorrow = TerritoryTask::whereDate('period', Carbon::tomorrow()->startOfDay())->count();
        $countToday = TerritoryTask::whereDate('period', Carbon::today()->startOfDay())->count();
        $countExpired = TerritoryTask::whereDate('period', '<', Carbon::today()->startOfDay())->count();
        $countAccepted = TerritoryTask::where('status', 4)->count();

        $categories = Category::all();
        $territories = Territory::all();

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.report2', [
            'models' => $territorytasks,
            'territoryTasks' => $territorytasks,
            'categories' => $categories,
            'territories' => $territories,
            'countAll' => $countAll,
            'countTwo' => $countTwo,
            'countTomorrow' => $countTomorrow,
            'countToday' => $countToday,
            'countExpired' => $countExpired,
            'countAccepted' => $countAccepted,
            'AlertCount' => $AlertCount
        ]);

    }

    public function filterReport(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $territoryTasksQuery = TerritoryTask::query();

        if ($start_date && $end_date) {
            $territoryTasksQuery->whereBetween('period', [$start_date, $end_date]);
        }

        $territoryTasks = $territoryTasksQuery->get();

        $categories = Category::all();
        $territories = Territory::all();

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.report2', [
            'models' => $territoryTasks, 
            'categories' => $categories,
            'territories' => $territories,
            'territoryTasks' => $territoryTasks,
            'AlertCount' => $AlertCount,
        ]);
    }

}
