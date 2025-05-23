<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlightMaster;
class FlightMasterController extends Controller
{
    protected $flightmaster;
    public function __construct(){
        $this->flightmaster = new FlightMaster();
    }
 public function index()
{
    
    $response['flightmasters'] = $this->flightmaster->all();

$json = file_get_contents('C:/xampp/htdocs/airline/airline/airports.json');

  $airports = collect(json_decode($json, true))
    ->filter(function($airport) {
        return isset($airport['status']) && $airport['status'] == 1 
            && isset($airport['type']) && $airport['type'] != 'closed';
    })
    ->pluck('name')
    ->map(function($name) {
        return mb_convert_encoding($name, 'UTF-8', 'auto');
    })
    ->filter()
    ->unique()
    ->sort()
    ->values();


    $response['airports'] = $airports;

    return view('pages.flightmaster.index')->with($response);

}

    
    public function store(Request $request)
    {

        $request->validate([
        'DepartureCity' => 'required',
        'ArrivalCity' => 'required|different:DepartureCity',
        'DepartureTime' => 'required',
        'ArrivalTime' => 'required',
    ],);

    $this->flightmaster->create($request->all());

    return redirect()->back();
    }
  public function edit(string $id)
{
    $flightmasters = $this->flightmaster->findOrFail($id);

$json = file_get_contents('C:/xampp/htdocs/airline/airline/airports.json');
    $airports = collect(json_decode($json, true))
        ->pluck('name')
        ->filter()
        ->unique()
        ->sort()
        ->values();

    return view('pages.flightmaster.edit', compact('flightmasters', 'airports'));
}

    public function update(Request $request, string $id)
    {
        $flightmaster = $this->flightmaster->find($id);
        $flightmaster->update(array_merge($flightmaster->toArray(), $request->toArray()));
        return redirect('flightmaster');
    }
    public function destroy(string $id)
    {
        $flightmaster = $this->flightmaster->find($id);
        $flightmaster->delete();
        return redirect('flightmaster');
    }

}
