<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // By default, Eloquent expects created_at and updated_at columns to exist on your tables.
    public $timestamps = false; // Since these columns were not added in the table, we disable it.
}
