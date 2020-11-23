<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    use HasFactory;

    protected $fillable = [
        'title',
        'dateFrom',
        'dateTo',
        'description',
        'agencyID',
        'regionID',
    ];


}
