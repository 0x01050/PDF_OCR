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
        'name', 'app_id', 'type', 'name'
    ];

    public function app() {
        return $this->belongsTo('App\Models\App');
    }
}
