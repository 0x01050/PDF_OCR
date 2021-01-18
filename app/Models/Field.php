<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $table = 'fields';
    protected $primaryKey = 'id';
    protected $fillable = [
        'app_id', 'type', 'model', 'sub', 'name', 'value'
    ];

    public function app() {
        return $this->belongsTo('App\Models\App');
    }
}
