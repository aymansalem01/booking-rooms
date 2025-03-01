@extends('layouts.adminPage')

@extends('layouts.adminPage')

@section('content')
    <div class="content">
       
        <div class="container mt-5">
            <div class="row justify-content-center">
            
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100 shadow-lg border-0 rounded-4 p-3 d-flex flex-column align-items-center text-center">
                            <div class="card-body flex-grow-1 d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark">room name</h5>
                                <p class="text-warning fs-5 mb-2">room text</p>
                                                        </div>
                            <div style="display: flex; gap: 80px; justify-content:center;"><i class="fa-solid fa-trash" style="color:red;"></i><i class="fa-solid fa-eye" style="color: #B197FC;"></i></div>
                        </div>
                    </div>
             
            </div>
        </div>
    </div>
@endsection
