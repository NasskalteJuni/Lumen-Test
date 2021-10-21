<?php

namespace App\Models;

use App\Traits\usesUuid;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model{

    use usesUuid;

    protected $dateFormat = "c";    // use ISO8601 for dates, ergo: 2021-12-24T18:55:00

    protected $fillable = [
        'title',
        'description',
        'done'
    ];

}
