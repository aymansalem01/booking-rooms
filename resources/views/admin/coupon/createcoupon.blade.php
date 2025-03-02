@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777; padding-bottom:20px" class="text-center mb-4">Add Coupon</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="coupon-form">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                    
                        <div class="form-group">
                            <label for="name">Coupon Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="discount">Discount Percentage</label>
                            <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}" min="1" max="100" required>
                            @error('discount')
                                <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    
                        <button type="submit" class="btn-submit">Add Coupon</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .coupon-form {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);

        margin-left: 60%;
        margin-right: -200px;
    }
    .form-group {
        margin-bottom: 15px;
        
    }
    .form-group label {
        font-weight: bold;
        color: #333;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .btn-submit {
        width: 100%;
        padding: 10px;
        background-color: #B197FC;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1.2em;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
        background-color: #8c6efc;
    }
</style>
