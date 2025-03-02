@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="padding-bottom:20px; color: #777" class="text-center mb-4">Add Category</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 coupon-container">
                <div class="coupon-form">
                    <form action="{{ route('adcategory.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="page">Background Color</label>
                            <input type="text" class="form-control" id="page" name="page" value="{{ old('page') }}" required>
                            @error('page')
                                <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="text">Text Color</label>
                            <input type="text" class="form-control" id="text" name="text" value="{{ old('text') }}" required>
                            @error('text')
                                <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="color">Button Color</label>
                            <input type="text" class="form-control" id="color" name="color" value="{{ old('color') }}" required>
                            @error('color')
                                <div class="custom-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    
                        <button type="submit" class="btn-submit">Add Category</button>
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
