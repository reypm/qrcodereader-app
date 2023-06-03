<?php

namespace App\Listeners;

class RemoveFile
{
    public function handle(RemoveFile $event): void
    {
        $submission = $event->submission;

        $document = $event->document;

        $documentPath = '/app/' . $document->path;
        storage_path($documentPath);

        $submission->delete();
    }
}
