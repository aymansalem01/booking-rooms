@extends('layouts.adminPage')


@section('content')
<div class="container mt-4">
    <h2 class="text-center text-purple fw-bold">Edit Room</h2>

    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-body">
            <form action="{{ route('room.update', $rooms->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Room Name</label>
                    <input type="text" class="form-control" value="{{ $rooms->name }}" disabled name="name">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" class="form-control" value="{{ $rooms->address }}" disabled name="address">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Price ($)</label>
                    <input type="number" class="form-control" name="price" value="{{ $rooms->price }}" required name="price">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select" name="status">
                        <option value="av"  name="av"{{ $rooms->status == 'av' ? 'selected' : '' }}>Available</option>
                        <option value="notav" name="notav" {{ $rooms->status == 'not_available' ? 'selected' : '' }}>Not Available</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Room Count</label>
                    <input type="number" class="form-control" name="count" value="{{ $rooms->count }}" required name="count">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea class="form-control" name="description" rows="3" required name="description">{{ $rooms->description }}</textarea>
                </div>

                <!-- <div class="mb-3">
                    <label class="form-label fw-bold">Add New Images</label>
                    <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                </div> -->

                <h5 class="fw-bold">Current Images</h5>
                {{-- <div class="row">
                    @foreach($rooms->images as $image)
                    <div class="col-md-3 position-relative">
                        <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail" alt="Room Image">
                        {{-- <form action="{{ route('admin.room.deleteImage', $image->id) }}" method="POST" class="position-absolute top-0 end-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">X</button>
                        </form> --}}
                    {{-- </div>
                    @endforeach
                </div> --}} 

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-success">Update Room</button>
                    <a href="{{ route('room.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
