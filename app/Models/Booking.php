<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['passenger_id', 'flightmaster_id', 'seat_number'];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function flightmaster()
    {
        return $this->belongsTo(FlightMaster::class);
    }
}
?>