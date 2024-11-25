<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\StoreRequest;
use App\Models\Answer;
use App\Http\Controllers\Controller;
use App\Models\TerritoryTask;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = Answer::orderBy('id', 'desc')->paginate(10);

        $AlertCount = TerritoryTask::where('status', 3)->count();

        return view('pages.answer', ['models' => $answers, 'AlertCount' => $AlertCount]);
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

        Answer::create($data);
        $territoryTask = TerritoryTask::where('id', $request->task_id)->first();
        $territoryTask->status = 3;
        $territoryTask->save();
        return redirect('/taskUser/1')->with('success', 'Javob jo\'natildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
    public function acceptAnswer(Request $request, Answer $answer)
    {
        $acceptValue = $request->status;
        $answer->status = $acceptValue;
        $task = TerritoryTask::findOrFail($answer->task_id);
        $task->status = $request->acceptAnswer;
        $task->save();
        $answer->save();
        return redirect('/answer');
    }

    public function reject(Request $request, Answer $answer)
    {
        $answer->status = $request->status;
        $answer->comment = $request->comment;
        $task = TerritoryTask::find($answer->task_id);
        $task->status = $request->reject;
        $task->save();
        $answer->save();
        return redirect('/answer');

    }

    public function reanswer(Request $request, TerritoryTask $task)
    {
        // dd($request->all());
        $task->status = $request->reanswer;
        foreach ($task->answers as $answer) {
            $answer = Answer::findOrFail($answer->id);

        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            if ($extension !== 'pdf') {
                return redirect()->back()->with('danger', 'File must be in PDF format.');
            }

            $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
            $file->move('pdf_upload/', $filename);
            $filePath = 'pdf_upload/' . $filename;
            $answer->file = $filePath;
        }
        $answer->title = $request->title;
        $answer->status = $request->status;
        // dd($answer);
        $task->save();
        $answer->save();
        return redirect('/taskUser/1');

    }

    public function incomingAnswer()
    {
        $answers = Answer::where('status', 1)->orderBy('id', 'desc')->paginate(10);

        $AlertCount = TerritoryTask::where('status', 3)->count();
        return view('pages.answer', ['models' => $answers, 'AlertCount' => $AlertCount]);

    }
}
