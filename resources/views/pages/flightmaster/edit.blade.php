@extends('layout.app')

@section('content')

    <div class="container">

        <h3 style="font-weight: bold;font-size: 50px;" align="center" class="mt-5">Flight Master Edit</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('flightmaster.update', $flightmasters->id) }}">
                {!! csrf_field() !!}
                  @method("PATCH")
                    <div class="row">
                      <div class="col-md-6">
    <label style="font-weight: bold;">Departure Airport</label>
    <select name="DepartureCity" class="form-control">
        <option value="">Select Departure Airport</option>
        @foreach($airports as $airport)
            <option value="{{ $airport }}" {{ $flightmasters->DepartureCity == $airport ? 'selected' : '' }}>
                {{ $airport }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-6">
    <label style="font-weight: bold;">Arrival Airport</label>
    <select name="ArrivalCity" class="form-control">
        <option value="">Select Arrival Airport</option>
        @foreach($airports as $airport)
            <option value="{{ $airport }}" {{ $flightmasters->ArrivalCity == $airport ? 'selected' : '' }}>
                {{ $airport }}
            </option>
        @endforeach
    </select>
</div>

                         <div class="col-md-6">
                            <label style="font-weight: bold;">Departure Time</label>
                            <input type="time" class="form-control" name="DepartureTime" value="{{ $flightmasters->DepartureTime }}">
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: bold;">Arrival Time</label>
                            <input type="time" class="form-control" name="ArrivalTime" value="{{ $flightmasters->ArrivalTime }}">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-primary" style="font-weight: bold;" value="Update">
                        </div>

                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>

@endsection


@push('css')
    <style>
        .form-area{
            padding: 20px;
            margin-top: 20px;
            background-color:#b3e5fc;
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
    </style>
@endpush
