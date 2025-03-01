@extends('layouts.adminPage')
@section('content')
   
<div class="content">
    <div class="container-fluid">
      
    
        
            <div class="row">
                
                <div class="col-md-4">
                    <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                        <div class="card-body text-center">
                            <i class="fas fa-bed fa-4x mb-3 icon-style"></i>
                            <h5 class="card-title">Rooms</h5>
                            <h3 class="card-number">6</h3>
                        </div>
                    </div>
                </div>
                
                
        
                <div class="col-md-4">
                    <div  class="card custom-card text-white shadow-lg border-0 hover-effect">
                        <div class="card-body text-center d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-calendar-check fa-3x icon-style"></i>
                                <h5 class="card-title">Booking</h5>
                                <h3 class="card-number">7</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                        <div class="card-body text-center d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-users fa-3x icon-style"></i>
                                <h5 class="card-title">Users</h5>
                                <h3 class="card-number">6</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                        <div class="card-body text-center d-flex align-items-center justify-content-between">
                            <div> 
                                <i class="fas fa-dollar-sign fa-3x icon-style"></i>
                                <h5 class="card-title">Revenue</h5>
                                <h3 class="card-number">$12,000</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                        <div class="card-body text-center d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-star fa-3x icon-style"></i>
                                <h5 class="card-title">Reviews</h5>
                                <h3 class="card-number">89</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                        <div class="card-body text-center d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-headset fa-3x icon-style"></i>
                                <h5 class="card-title">Owners</h5>
                                <h3 class="card-number">15</h3>
                            </div>
                            
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
            .custom-card {
        background: linear-gradient(135deg, #007bff, #6610f2); /* تدرج لوني */
        border-radius: 15px; /* زوايا مستديرة */
        padding: 20px;
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    /* تأثير hover */
    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.08);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* تحسين شكل النص */
    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .card-number {
        font-size: 2rem;
        font-weight: bold;
    }

    /* تحسين شكل الأيقونة */
    .icon-style {
        opacity: 0.8;
        transition: transform 0.3s ease-in-out;
    }
    .hover-effect:hover .icon-style {
        transform: rotate(10deg) scale(1.1);
    }

    /* تأثير الوميض */
    .custom-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(25deg);
        transition: all 0.5s ease-in-out;
    }

    .hover-effect:hover::before {
        top: -30%;
        left: -30%;
        background: rgba(255, 255, 255, 0.15);
    }
    .custom-card {
        background: linear-gradient(135deg, #e262ff, #a166ff);
        border-radius: 12px;
        padding: 15px;
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url("{{ assess('') }}")
    }

    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    /* تكبير وتحسين النص */
    .card-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white
    }

    .card-number {
        font-size: 3rem;
        font-weight: bold;
        color: white
    }
    .icon-style {
        opacity: 0.9;
        transition: transform 0.3s ease-in-out;
        color: rgb(255, 255, 255)
    }
    .hover-effect:hover .icon-style {
        transform: rotate(5deg) scale(1.1);
    }
    .row{
        margin-right: 0 !important;
        margin-left: 0 !important;
    }
        </style>
        
        
    
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