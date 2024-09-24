<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Year;
use App\Models\SubmissionYear;

class Record extends Model
{
    protected $fillable = [
        'year_id', 'month', 'folder_name', 'folder_type', 'number',
        'submission_year_id', 'submission_month', 'status', 'others', 'remarks'
    ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function submissionYear()
    {
        return $this->belongsTo(SubmissionYear::class);
    }
}

