<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\FlightMaster;

class BookingController extends Controller
{
    protected $booking;

    public function __construct()
    {
        $this->booking = new Booking();
    }

    public function index()
    {
        $response['bookings'] = $this->booking->with(['passenger', 'flightmaster'])->get();
        $response['passengers'] = Passenger::all();
        $response['flightmasters'] = FlightMaster::all();

        return view('pages.booking.index')->with($response);
    }

    public function store(Request $request)
    {
        $this->booking->create($request->all());
        return redirect()->back();
    }

public function edit($id)
{
  
    $booking = Booking::findOrFail($id);
    $flightmasters = $booking->flightmaster;

    $airportsData = json_decode(file_get_contents(base_path(path: ''../airports.json')), true);
    $airports = array_column($airportsData, 'name');

    return view('pages.booking.edit', compact('booking', 'flightmasters', 'airports'));

}

    public function update(Request $request, string $id)
    {
        $booking = $this->booking->find($id);
        $booking->update($request->all());
        return redirect('booking');
    }

    public function destroy(string $id)
    {
        $booking = $this->booking->find($id);
        $booking->delete();
        return redirect('booking');
    }
}
?>
