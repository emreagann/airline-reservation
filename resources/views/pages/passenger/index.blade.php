@extends('layout.app')

@section('content')
@include('layout.navbar')
    <div class="container">

        <h3  style="font-weight: bold; font-size: 50px;" align="center" class="mt-5">Passenger Information</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('passenger.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label style="font-weight: bold;">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: bold;">Age</label>
                            <input type="number" min="0" class="form-control" name="age">
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: bold;">Gender</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label style="font-weight: bold;">Phone</label>
                            <input type="number" maxlength="11" class="form-control" name="phone">

                        </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-secondary"  style="font-weight: bold;" value="Submit">
                        </div>

                    </div>
                </form>
            </div>

                <table class="table mt-5">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ( $passengers as $key => $passenger )

                        <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $passenger->name }}</td>
                            <td scope="col">{{ $passenger->age }}</td>
                            <td scope="col">{{ $passenger->gender }}</td>
                            <td scope="col">{{ $passenger->phone }}</td>
                            <td scope="col">

                            <a href="{{  route('passenger.edit', $passenger->id) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            
                            <form action="{{ route('passenger.destroy', $passenger->id) }}" method="POST" style ="display:inline">
                             @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i>
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
              background-color:#b2b8d4;
        }
        table th, table td {
    font-weight: bold !important;
}
    </style>
@endpush
