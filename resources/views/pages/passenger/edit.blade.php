@extends('layout.app')

@section('content')
@include('layout.navbar')
    <div class="container">

        <h3 style="font-weight: bold; font-size: 50px;" align="center" class="mt-5">Passenger</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('passenger.update', $passengers->id) }}">
                {!! csrf_field() !!}
                  @method("PATCH")
                    <div class="row">
                        <div class="col-md-6">
                            <label style="font-weight: bold;">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $passengers->name }}">
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: bold;">Age</label>
                            <input type="text" class="form-control" name="age" value="{{ $passengers->age }}">
                        </div>
                         <div class="col-md-6">
                            <label style="font-weight: bold;">Gender</label>
                            <select class="form-select" aria-label="Default select example" name="gender">
                                <option value="Male" {{ $passengers->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $passengers->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label style="font-weight: bold;">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $passengers->phone }}">
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
        table th, table td {
    font-weight: bold;
}
    </style>
@endpush
