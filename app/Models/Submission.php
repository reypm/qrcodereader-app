<?php

namespace App\Models;

use App\Models\Enums\SubmissionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Submission extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'code'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => SubmissionStatusEnum::class
    ];

    public function document(): HasOne
    {
        return $this->hasOne(Document::class, 'submission_id');
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
