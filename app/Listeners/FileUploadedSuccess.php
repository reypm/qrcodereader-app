<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use App\Models\Enums\SubmissionStatusEnum;
use Illuminate\Support\Facades\Log;
use TarfinLabs\ZbarPhp\Exceptions\ZbarError;
use TarfinLabs\ZbarPhp\Zbar;

class FileUploadedSuccess
{
    public function handle(FileUploaded $event): void
    {
        $document = $event->document;
        $submission = $event->submission;

        $documentPath = '/app/' . $document->path;

        $zbar = new Zbar(storage_path($documentPath));

        try {
            $barCode = $zbar->decode();

            $submission->code = $barCode->code();
            $submission->status = SubmissionStatusEnum::Processed;
            $submission->save();
        } catch (ZbarError $e) {
            $message = [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];

            Log::critical('ZBAR-ERROR', $message);
        }
    }
}
