@extends('layouts.adminPage')

@section('content')

<style>
    .card {
    background: white;
    border-radius: 15px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    margin-top: 80px;
    text-align: center;
}

.card img {
    border: 5px solid #ddd;
    transition: transform 0.3s ease;
}

.card img:hover {
    transform: scale(1.05);
}

.badge {
    font-size: 14px;
    font-weight: 600;
    border-radius: 20px;
    padding: 8px 16px;
}

.details-card {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
}

.room-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.room-card:hover {
    transform: translateY(-5px);
}

.room-card img {
    height: 200px;
    object-fit: cover;
}

.view-room-btn {
    border-radius: 25px;
    font-weight: 600;
    padding: 8px 20px;
    transition: background 0.3s ease;
}
.list-group-item{
   
    border: none
}

.view-room-btn:hover {
    background: #5a5a5a;
    color: white;
}
</style>
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <div class="text-center">
                <img src="{{ asset('images/' . $user->image) }}" alt="User Image" class="rounded-circle mb-3" width="120" height="120">
                <h4 class="fw-bold">{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-info' }}">
                    {{ ucfirst($user->role) }}
                </span>
                <span class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($user->status) }}
                </span>
            </div>
            
            <hr>

           
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone_number }}</li>
                <li class="list-group-item"><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</li>
            </ul>

            @if($user->role == 'owner' && $user->rooms->count() > 0)
            <h5 class="fw-bold">Rooms Owned</h5>
            <div class="row">
                @foreach($user->rooms as $room)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset('assets/img/' . $room->images->first()->path) }}" class="card-img-top" alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text"><strong>Price:</strong> ${{ $room->price }}</p>
                            <p class="card-text"><strong>Address:</strong> {{ $room->address }}</p>
                            <a href="{{ route('room.show', $room->id) }}" class="btn btn-primary btn-sm">View Room</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
            @else
            <p class="text-muted">This user does not own any rooms.</p>
            @endif
        </div>
    </div>
</div>
@endsection
