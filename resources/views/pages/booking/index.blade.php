@extends('layout.app')

@section('content')
@include('layout.navbar')
    <div class="container">

        <h3 style="font-weight: bold;font-size: 50px;" align="center" class="mt-5">Booking Information</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('booking.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                           <label style="font-weight: bold;">Passenger</label>
<select class="form-control" name="passenger_id" required>
    <option value="">Select Passenger</option>
    @foreach($passengers as $passenger)
        <option value="{{ $passenger->id }}">{{ $passenger->name }}</option>
    @endforeach
</select>
                        </div>
                        <div class="col-md-6">
                           <label style="font-weight: bold;">Flight</label>
<select class="form-control" name="flightmaster_id" required>
    <option value="">Select Flight</option>
    @foreach($flightmasters as $flight)
        <option value="{{ $flight->id }}">
            {{ $flight->DepartureCity }} → {{ $flight->ArrivalCity }} ({{ $flight->DepartureTime }} - {{ $flight->ArrivalTime }})
        </option>
    @endforeach
</select>
                        </div>
                         <div class="col-md-6">
                            <label style="font-weight: bold;">Seat Number</label>
                            <input type="text" class="form-control" name="seat_number">
                        </div>
                            <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-info" style="font-weight: bold;" value="Submit">
                        </div>

                    </div>
                </form>
            </div>
                <table class="table mt-5">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Passenger Name</th>
                        <th scope="col">Departure Time</th>
                        <th scope="col">Arrival Time</th>
                        <th scope="col">Departure Airport</th>
                        <th scope="col">Arrival Airport</th>
                        <th scope="col">Seat Number</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ( $bookings as $key => $booking )

                          <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $booking->passenger->name }}</td>
                            <td scope="col">{{ $booking->flightmaster->DepartureTime }}</td>
                            <td scope="col">{{ $booking->flightmaster->ArrivalTime }}</td>
                            <td scope="col">{{ $booking->flightmaster->DepartureCity }}</td>
                            <td scope="col">{{ $booking->flightmaster->ArrivalCity }}</td>
                            <td scope="col">{{ $booking->seat_number }}</td>
                            <td scope="col">

                            <a href="{{  route('booking.edit', $booking->id) }}">
                            <button style="font-weight: bold;" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>

                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style ="display:inline">
                             @csrf
                            @method('DELETE')
                            <button style="font-weight: bold;" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i>
                                Delete</button>
                            </form>
                            </td>

                          </tr>

                        @endforeach




                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection


@push('css')
    <style>
        .form-area{
            padding: 20px;
            margin-top: 20px;
              background-color:#7abfcd;
        }

        .bi-trash-fill{
            color:red;
            font-size: 18px;
        }

        .bi-pencil{
            color:green;
            font-size: 18px;
            margin-left: 20px;
        }
        table th, table td {
    font-weight: bold !important;
}
    </style>
@endpush
