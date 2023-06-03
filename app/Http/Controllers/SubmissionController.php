<?php

namespace App\Http\Controllers;

use App\Events\FileUploaded;
use App\Http\Requests\SubmissionRequest;
use App\Models\Document;
use App\Models\Submission;
use Illuminate\Contracts\Foundation\Application as ApplicationFoundation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|ApplicationFoundation
    {
        $filePerPage = env('FILES_PER_PAGE', 15);
        $submissions = Submission::paginate($filePerPage);

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
    public function store(SubmissionRequest $request): Application|Redirector|RedirectResponse|ApplicationFoundation
    {
        $uploadDir = env('FILES_UPLOAD_DIR', 'uploads');
        $filePath = $request->file('file')->store($uploadDir);
        Storage::setVisibility($filePath, 'public');

        $submission = Submission::create([
            'user_id' => auth()->id()
        ]);

        $document = Document::create([
            'path' => $filePath,
            'user_id' => auth()->id(),
            'submission_id' => $submission->id
        ]);

        FileUploaded::dispatch($submission, $document);

        return redirect('/submission')->with('success', 'You have successfully uploaded a file.');
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
        $t = 0;
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
        // softDeletes are enabled but if we can get rid of them then we should use an event that also would take care
        // of uploaded files
        // RemoveStoredFile::dispatch($submission);

        $submission->delete();

        return redirect('/submission')->with('success', "Submission successfully deleted");
    }
}
