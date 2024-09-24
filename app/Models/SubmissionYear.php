<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;

class SubmissionYear extends Model
{
    protected $fillable = ['year'];

    public function records()
    {
        return $this->hasMany(Record::class, 'submission_year_id', 'id');
    }
}

