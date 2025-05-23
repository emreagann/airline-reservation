@extends('layout.app')

@section('content')
@include('layout.navbar')
    <div class="container">

        <h3 style="font-weight: bold;font-size: 50px;" align="center" class="mt-5">Flight Information</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('flightmaster.store') }}">
                    @csrf
                    <div class="row">
                       <div class="col-md-6">
    <label  style="font-weight: bold;">Departure Airport</label>
    <select name="DepartureCity" class="form-control">
        <option value="">Select Departure Airport</option>
        @foreach($airports as $airport)
            <option value="{{ $airport }}">{{ $airport }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-6">
    <label style="font-weight: bold;">Arrival Airport</label>
    <select name="ArrivalCity" class="form-control">
        <option value="">Select Arrival Airport</option>
        @foreach($airports as $airport)
            <option value="{{ $airport }}">{{ $airport }}</option>
        @endforeach
    </select>
</div>

                         <div class="col-md-6">
                            <label style="font-weight: bold;">Departure Time</label>
                            <input type="time" class="form-control" name="DepartureTime">
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: bold;">Arrival Time</label>
                            <input type="time" class="form-control" name="ArrivalTime">
                        </div>
                            <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-warning" style="font-weight: bold;" value="Submit">
                        </div>

                    </div>
                </form>
            </div>
                <table class="table mt-5">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Departure Airport</th>
                        <th scope="col">Arrival Airport</th>
                        <th scope="col">Departure Time</th>
                        <th scope="col">Arrival Time</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ( $flightmasters as $key => $flightmaster )

                          <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $flightmaster->DepartureCity }}</td>
                            <td scope="col">{{ $flightmaster->ArrivalCity }}</td>
                            <td scope="col">{{ $flightmaster->DepartureTime }}</td>
                            <td scope="col">{{ $flightmaster->ArrivalTime }}</td>
                            <td scope="col">

                            <a href="{{  route('flightmaster.edit', $flightmaster->id) }}">
                            <button  style="font-weight: bold;" class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            
                            <form action="{{ route('flightmaster.destroy', $flightmaster->id) }}" method="POST" style ="display:inline">
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
              background-color:#ffb300;
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
    font-weight: bold;
}
    </style>
@endpush
