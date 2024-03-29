<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'submitted_at'
    ];

    public function fields() {
        return $this->hasMany('App\Models\Field');
    }
}
