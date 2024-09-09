<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFilter extends Model
{
    use HasFactory;

    protected $table = "data_filters";

    protected $fillable = [
        'table_name',
        'column_name',
        'possible_values'
    ];
}
