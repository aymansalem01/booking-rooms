@extends('layouts.adminPage')

@section('content')
<style>

   

       
        .filter{

            display: flex;
            align-items: center

        }
      
        .searcTxt{

            width: 52%;
        }
        .num{
            width: 40%
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
        .apply {
            background-color: #9282ffdd;
border: 1px solid #9282ffdd;
color: white;

}

.apply:hover {
border: 1px solid #9282ffdd;
color: #9282ffdd;
background-color: white
}

    .user-card {
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        transition: 0.3s ease-in-out;
        margin-top: 20px;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
    }

    .user-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 1px solid #ddd;
        padding: 3px;
        border-radius: 20%;
    }

    .icons {
        display: flex;
        justify-content: center;
        gap: 5px;
        padding: 10px;
        border-radius: 50%;
    }

    .adduser {
        background-color: #9282ffdd;
        border: 1px solid #9282ffdd;
        color: white;
        width: 20%;
    }

    .adduser:hover {
        border: 1px solid #9282ffdd;
        color: #9282ffdd;
    }

    .iconn {
        border-radius: 30%;
    }

    .eyeIcon {
        color: #9282ffdd;
        border-color: #9282ffdd;
    }

    .badge {
        padding: 10px;
        font-size: 1.4rem;
    }

    .form-container {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: center;
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-input {
        width: 250px;
    }

    .filter-select {
        width: 180px;
    }

    .form-group button {
        margin-top: 0;
    }

    .filter-box {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .filter-form .form-control {
        border-radius: 6px;
    }

    .filter-form{
        display: flex;
        justify-content: space-between;
        align-content: center
    }
    @media (max-width: 768px) {
        .form-container {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<div class="container mt-4" style="min-height: 100vh; display: flex; flex-direction: column;">
    

    <h2 style="color: #777" class="text-center text-purple fw-bold">User Management</h2>
    <div>
    <form method="GET" action="{{ route('admin.search') }}" class="filter-box filter-form ">
  
        <input type="hidden" name="page" value="users">

        <div class="form-container">
            <div class="form-group">
                <input type="text" name="query" class="form-control search-input" placeholder="Search users..." value="{{ request('query') }}">
            </div>

            <div class="form-group">
                <select name="role" class="form-control filter-select">
                    <option value="">Filter by role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>

            <div class="form-group">
                <select name="status" class="form-control filter-select">
                    <option value="">Filter by status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="col-12 text-center mt-3 search"">
            <a href="{{ route('user.index') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
            <button type="submit" class="btn btn-primary apply">Filter</button>
            
         
        </div>
    </form>
</div>

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

                    <span class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ $user->status == 'active' ? 'Active' : 'Inactive' }}
                    </span>

                    <div class="mt-3 icons">
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-secondary iconn eyeIcon">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm iconn">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger iconn delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-container">
        {{ $users->appends(['query' => request('query'), 'role' => request('role')])->links('pagination::bootstrap-4') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function (event) {
                event.preventDefault();
                let form = this.closest("form");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Deleted!",
                            text: "The user has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>

@endsection
