@extends('layouts.adminPage')
@section('content')
   
<div class="content">
    <div class="container-fluid">
      
    
        
            <div class="row">
                <!-- الغرف -->
                <div class="col-md-4">
                    <div class="card bg-primary text-white shadow-lg rounded-lg border-0 hover-effect">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Rooms</h5>
                                <h3>6</h3>
                            </div>
                            <i class="fas fa-bed fa-3x"></i>
                        </div>
                    </div>
                </div>
        
                <!-- الحجوزات -->
                <div class="col-md-4">
                    <div class="card bg-success text-white shadow-lg rounded-lg border-0 hover-effect">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Booking</h5>
                                <h3>7</h3>
                            </div>
                            <i class="fas fa-calendar-check fa-3x"></i>
                        </div>
                    </div>
                </div>
        
                <!-- المستخدمون -->
                <div class="col-md-4">
                    <div class="card bg-warning text-white shadow-lg rounded-lg border-0 hover-effect">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Users</h5>
                                <h3>6</h3>
                            </div>
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- صف آخر -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-danger text-white shadow-lg rounded-lg border-0 hover-effect">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Revenue</h5>
                                <h3>$12,000</h3>
                            </div>
                            <i class="fas fa-dollar-sign fa-3x"></i>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card bg-info text-white shadow-lg rounded-lg border-0 hover-effect">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Reviews</h5>
                                <h3>89</h3>
                            </div>
                            <i class="fas fa-star fa-3x"></i>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card bg-dark text-white shadow-lg rounded-lg border-0 hover-effect">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Support Tickets</h5>
                                <h3>15</h3>
                            </div>
                            <i class="fas fa-headset fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            .hover-effect {
                transition: transform 0.3s ease-in-out;
            }
            .hover-effect:hover {
                transform: scale(1.05);
            }
        </style>
        
        @endsection
        
    
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