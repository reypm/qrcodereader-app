<?php

namespace App\Events;

use App\Models\Document;
use App\Models\Submission;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Submission $submission, public Document $document)
    {
    }
}
