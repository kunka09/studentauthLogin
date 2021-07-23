<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address', 'contact', 'birthdate', 'course'];

    public function container() {
        return $this->belongsTo('App\Models\Student', 'name', 'id');
    }
}