<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightMaster extends Model
{
    use HasFactory;
    protected $table = 'flightmasters';
    protected $primarykey = 'id';
    protected $fillable = [
        'DepartureCity',
        'ArrivalCity',
        'DepartureTime',
        'ArrivalTime',
    ];
}
