<?php

namespace App\Models\Enums;

enum SubmissionStatusEnum: string
{
    case Processing = 'processing';
    case Error = 'error';
    case Processed = 'processed';
}
