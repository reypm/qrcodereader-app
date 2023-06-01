<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Models\Submission;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application as ApplicationFoundation;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|ApplicationFoundation
    {
        $submissions = Submission::all();

        return view('submission.index', [
            'submissions' => $submissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|ApplicationFoundation
    {
        return view('submission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubmissionRequest $request)
    {
        $files = [];
        if ($request->file('files')){
            foreach($request->file('files') as $file)
            {
                $fileName = time().rand(1,99).'.'.$file->extension();
                $file->move(public_path('uploads'), $fileName);
                $files[]['name'] = $fileName;
            }
        }

        foreach ($files as $file) {
            Submission::create($file);
        }

        return back()->with('success','You have successfully upload file.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submission $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission): RedirectResponse
    {
        $submission->delete();

        return back(204)->with([
            'success' => __("Submission successfully deleted")
        ]);
    }
}
