@extends('layouts.ownerPage')

@section('content')
    <style>

        .info-section{

            padding: 40px
        }
        .info-section p {
    font-size: 16px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
  
}
.imgSec{
    padding: 40px;
}
.room-thumbnails {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 10px;
}

.thumbnail {
    width: 60px;
    height: 60px;
    cursor: pointer;
    opacity: 0.7;
    transition: 0.3s;
    border: 2px solid #9282ffdd;
    border-radius: 5px;
}

.thumbnail:hover,
.thumbnail.active {
    opacity: 1;
    border: 2px solid #ce05a2;
}

#main-room-image {
    width: 100%;
    max-height: 350px;
    object-fit: cover;
    border-radius: 10px;
}
.titlee{
    padding-left: 40px;
    font-size: 4rem;
    color: #777 !important;
}
.card{
    width: 70%;
    margin:auto;
    margin-top: 5%;
    margin-bottom: 5%;
    padding: 20px

}
.btnsDiv{
    padding-left: 40px
}
.adduser {
    background-color: #9282ffdd;
    border: 1px solid #9282ffdd;
    color: white;
  
   
}

.adduser:hover {
    border: 1px solid #9282ffdd;
    color: #9282ffdd;
}
.backbtn {
    background-color: #9282ffdd;
    border: 1px solid #9282ffdd;
    color: white;
  
   
}

.backbtn:hover {
    border: 1px solid #9282ffdd;
    color: #9282ffdd;
}
    </style>
    <div class="container mt-4">
       

       
        
            <div class="card shadow-lg border-0 rounded-lg p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="titlee">{{ $room->name }}</h3>
        
                        <div class="info-section">
                            <p><strong>Address:</strong> {{ $room->address }}</p>
                            <p><strong>Price:</strong> ${{ $room->price }}</p>
                            <p><strong>Discount:</strong> %{{ $room->discount }}</p>
                            <p><strong>Price After Discount:</strong> ${{ $room->total_price }}</p>
                            <p><strong>Room Type:</strong> {{ $room->category->name }}</p>
                            <p><strong>Count:</strong> {{ $room->count }}</p>
                            <p><strong>Size:</strong> {{ $room->size }} m²</p>
                            <p><strong>Capacity:</strong> {{ $room->capacity }} Persons</p>
                            <p><strong>Status:</strong> 
                                <span class="badge bg-success">{{ ucfirst($room->status) }}</span>
                            </p>
                            <p><strong>Description:</strong> {{ $room->description }}</p>
                        </div>
        
                        <div class="mt-3 btnsDiv">
                            <a href="{{ route('room.index') }}" class="btn backbtn">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                            <a href="{{ route('addimage', $room->id) }}" class="btn adduser">
                                <i class="fa-solid fa-images"></i> Add Image
                            </a>
                        </div>
                    </div>
        
                    <div class="col-md-6 text-center imgSec">
                        <img id="main-room-image" class="img-fluid rounded shadow" 
                             src="{{ asset('images/' . $room->image->first()->image) }}" alt="Room Image">
        
                        <div class="room-thumbnails mt-3 d-flex flex-wrap justify-content-center">
                            @foreach ($room->image as $image)
                                <img class="thumbnail" src="{{ asset('images/' . $image->image) }}" alt="Room Thumbnail">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const thumbnails = document.querySelectorAll(".thumbnail");
            const mainImage = document.getElementById("main-room-image");

            thumbnails.forEach(thumb => {
                thumb.addEventListener("click", function() {
                    mainImage.src = this.src;
                    thumbnails.forEach(t => t.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });
    </script>
@endsection
