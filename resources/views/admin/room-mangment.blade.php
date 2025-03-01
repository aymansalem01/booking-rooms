@extends('layouts.adminPage')

@section('content')

<div class="container mt-4">
    <h2 style="color: #777; padding-bottom:40px" class="text-center text-purple fw-bold">Rooms Management</h2>

    @if(session('updated'))
        <div class="alert alert-info">Room updated successfully!</div>
    @endif
    @if(session('deleted'))
        <div class="alert alert-danger">Room deleted successfully!</div>
    @endif



    <div class="row">
        @if($rooms->isEmpty())
    <p class="text-center text-muted">No rooms available.</p>
@else
    


        @foreach($rooms as $room)
        <div class="col-md-6">
            <div class="card room-card shadow-sm border-0 rounded-lg mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('assets/img/' . $room->image) }}" class="room-img rounded-start" alt="Room Image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $room->name }}</h5>
                            <p class="text-muted mb-2">
                                <strong>Address:</strong> {{ $room->address }} <br>
                                <strong>Price:</strong> {{ $room->price }} <br>
                                <strong>Status:</strong>
                                <span class="badge {{ $room->status == 'av' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $room->status == 'av' ? 'Avalible' : 'Not Avalible' }}
                                    {{ ucfirst($room->status) }}
                                </span> <br>
                                <strong>Count:</strong> {{ $room->count }}
                            </p>
                            <div style="display: flex; gap:5px" class="d-flex">
                                <a href="{{ route('room.show', $room->id) }}" class="btn btn-sm btn-info me-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('room.edit', $room->id) }}" class="btn btn-sm btn-warning me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('room.destroy', $room->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
    

<style>
  .room-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: 0.3s ease-in-out;
    padding: 30px;
}


.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
}

.room-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

</style>


        
    </div>
</div>
@endsection