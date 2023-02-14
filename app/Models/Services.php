<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = "services";

    protected $fillable = [
        "img",
        "type_service",
        "start_date",
        "end_date",
        "observations",
        "customer_id",
    ];

    //Relación de muchos a 1 
    public function customers() {
        return $this->belongsTo('App\Models\Customers','customer_id');
    }
}