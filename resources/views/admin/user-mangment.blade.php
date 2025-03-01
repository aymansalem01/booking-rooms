@extends('layouts.adminPage')
@section('content')
<style>
.user-card {
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    transition: 0.3s ease-in-out;
    margin-top: 20px
}

.user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
}

.user-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 3px solid #ddd;
    padding: 3px;
}
.icons{

    display: flex;
    justify-content: center;
    gap: 5px;
}
.adduser{
   
    border:1px solid rgb(161, 51, 209);
    color: rgb(161, 51, 209);
}
.adduser:hover{
   
    background-color: rgb(161, 51, 209);
    border:1px solid rgb(161, 51, 209);
    color: white;
}
</style>
<div class="container mt-4">
    <h2 style="color: #777" class="text-center text-purple fw-bold">User Management</h2>

    <div class="text-end mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-primary adduser">
            <i class="fas fa-user-plus"></i> Add New User
        </a>
    </div>

    <div class="row">
        @foreach($users as $user)
        <div class="col-md-4">
            <div class="card user-card shadow-sm border-0 rounded-lg">
                <div class="card-body text-center">
                    
                    <img src="{{ asset('images/' . $user->image) }}" alt="User Image" class="user-img rounded-circle">
                    
                    <h5 class="fw-bold mt-2">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>

                    <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-info' }}">
                        {{ ucfirst($user->role) }}
                    </span>

                    <span class="badge {{ $user->status == 'av' ? 'bg-success' : 'bg-danger' }}">
                        {{ $user->status == 'av' ? 'Active' : 'Inactive' }}
                    </span>

                    <div class="mt-3 icons">
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button  type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



@endsection
       