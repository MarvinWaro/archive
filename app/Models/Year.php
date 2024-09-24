<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;


class Year extends Model
{
    protected $fillable = ['year'];

    public function records()
    {
        return $this->hasMany(Record::class, 'year_id', 'id');
    }
}

