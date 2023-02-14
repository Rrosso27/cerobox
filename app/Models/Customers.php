<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = [
        "name",
        "document",
        "email",
        "telephone",
        "observations"
    ];

    //Relación de 1 a muchos 
    public function services () {
        return $this->hasMany('App\Models\Services');
    }
}