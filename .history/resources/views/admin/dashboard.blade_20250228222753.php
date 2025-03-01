@extends('layouts.adminPage')
@section('content')
   
<div class="content">
    <div class="container-fluid">
      
    
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white">
                    <div class="card-body">
                        <h5>Rooms</h5>
                        <h3>6</h3>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card text-white">
                    <div class="card-body">
                        <h5>Booking</h5>
                        <h3>7</h3>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card text-white">
                    <div class="card-body">
                        <h5>Users</h5>
                        <h3>6</h3>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="card mt-4">
            <div class="card-header">Last Booking</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Users</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach() --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


   @endsection