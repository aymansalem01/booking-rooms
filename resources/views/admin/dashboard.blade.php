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
                        <h3 class="card-number">{{ $roomsCount }}</h3>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-check fa-3x icon-style"></i>
                        <h5 class="card-title">Booking</h5>
                        <h3 class="card-number">{{ $bookingsCount }}</h3>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x icon-style"></i>
                        <h5 class="card-title">Users</h5>
                        <h3 class="card-number">{{ $usersCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                    <div class="card-body text-center">
                        <i class="fas fa-dollar-sign fa-3x icon-style"></i>
                        <h5 class="card-title">Revenue</h5>
                        <h3 class="card-number">${{ number_format($revenue, 2) }}</h3>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                    <div class="card-body text-center">
                        <i class="fas fa-star fa-3x icon-style"></i>
                        <h5 class="card-title">Reviews</h5>
                        <h3 class="card-number">{{ $reviewsCount }}</h3>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card custom-card text-white shadow-lg border-0 hover-effect">
                    <div class="card-body text-center">
                        <i class="fas fa-headset fa-3x icon-style"></i>
                        <h5 class="card-title">Owners</h5>
                        <h3 class="card-number">{{ $ownersCount }}</h3>
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
        background: linear-gradient(135deg, #007bff, #6610f2); 
        border-radius: 15px; 
        padding: 20px;
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    
    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.08);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    
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

    .icon-style {
        opacity: 0.8;
        transition: transform 0.3s ease-in-out;
    }
    .hover-effect:hover .icon-style {
        transform: rotate(10deg) scale(1.1);
    }

    
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
        background-image: url("{{asset('assets/img/card-3.jpg') }}");
        background-size:cover;
    }

    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    
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
    
        </style>
        
        
        <div class="card-header text-white fw-bold">
            Recent Bookings Summary
         </div>
         <div class="card mt-4 shadow-lg border-0 rounded-lg cardItem">
           
            <div class="card-body">
                <ul style="border: none" class="list-group list-group-flush">
                    {{-- @foreach($bookings as $booking) --}}
                    <li class="booking-item d-flex align-items-center justify-content-between hover-effect-list ">
            
                        <div class="user-info">
                        <i class="fas fa-user-circle fa-3x text-purple me-3" style="font-size: 6rem"></i>
        
                        <div class="d-flex flex-column">
                            <h6 style="font-size: 2rem" class="fw-bold mb-1">User Name <small class="text-muted">(#12345)</small></h6>
                            <small class="text-muted"><i class="fas fa-clock me-1"></i> 12 Feb 2025 - 3:45 PM</small>
                        </div>
                    </div>
                        <div class="d-flex flex-column align-items-center" style="display:flex; gap: 20px">
                            <span style="font-size: 2rem" class="badge bg-light text-dark p-2"><i style="font-size: 2rem" class="fas fa-credit-card me-1"></i> Credit Card</span>
                            <span style="font-size: 2rem" class="text-success fw-bold"><i style="font-size: 2rem" class="fas fa-check-circle me-1"></i> Confirmed</span>
                        </div>
        
                        <span  style="font-size: 2rem" class="badge bg-purple p-2 fw-bold fs-6">$120</span>
                    </li>
                    <li class="booking-item d-flex align-items-center justify-content-between hover-effect-list ">
            
                        <div class="user-info">
                        <i class="fas fa-user-circle fa-3x text-purple me-3" style="font-size: 6rem"></i>
        
                        <div class="d-flex flex-column">
                            <h6 style="font-size: 2rem" class="fw-bold mb-1">User Name <small class="text-muted">(#12345)</small></h6>
                            <small class="text-muted"><i class="fas fa-clock me-1"></i> 12 Feb 2025 - 3:45 PM</small>
                        </div>
                    </div>
                        <div class="d-flex flex-column align-items-center" style="display:flex; gap: 20px">
                            <span style="font-size: 2rem" class="badge bg-light text-dark p-2"><i style="font-size: 2rem" class="fas fa-credit-card me-1"></i> Credit Card</span>
                            <span style="font-size: 2rem" class="text-success fw-bold"><i style="font-size: 2rem" class="fas fa-check-circle me-1"></i> Confirmed</span>
                        </div>
        
                        <span  style="font-size: 2rem" class="badge bg-purple p-2 fw-bold fs-6">$120</span>
                    </li>
                    {{-- @endforeach --}}
                </ul>
            </div>
        </div>
        <style>
           
    .bg-purple {
        background-color: #6a0dad !important;
    }

    .text-purple {
        color: #6a0dad !important;
    }

    .cardItem{
        width: 80%;
        margin-left: 20px;
       border: none
    }
    .booking-item {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        transition: background 0.3s ease-in-out;
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 30px;
        width: 100%;
        border:none
    }

    .booking-item:hover {
        background: #f3e5ff;
    }

    .badge.bg-purple {
        font-size: 1.1rem;
        border-radius: 8px;
    }
    .user-info{

        display: flex;
         align-items: center;  
         gap: 10px
          }

          .card-header{

            padding-bottom: 20px;
            font-size: 2.5rem;
            color: #777;
            margin-left: 20px
          }
          .hover-effect-list {
        transition: transform 0.3s ease-in-out;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    
        
    }
    .hover-effect-list:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
        </style>
        
        
    </div>
    </div>


   @endsection