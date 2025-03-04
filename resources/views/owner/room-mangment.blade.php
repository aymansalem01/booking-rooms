@extends('layouts.ownerPage')

@section('content')

    <div class="page-container">
        <div class="container mt-4">

            <style>
                .search {

                    display: flex;
                    gap: 4px
                }

                .filter {

                    display: flex;
                    align-items: center
                }

                .searcTxt {

                    width: 52%;
                }

                .num {
                    width: 40%
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

                .apply {
                    color: #9282ffdd;
                    border: 1px solid #9282ffdd;
                    background-color: white;

                }

                .apply:hover {
                    border: 1px solid #9282ffdd;
                    background-color: #9282ffdd;
                    color: white
                }
            </style>
            <h2 style="color: #777; padding-bottom:50px" class="text-center text-purple fw-bold">Rooms Management</h2>

            <div style="padding-bottom: 50px" class="container mt-4">

                <form method="GET" action="{{ route('room.index') }}"
                    class="row align-items-center mb-4 p-3 bg-light rounded shadow-sm">
                    <div class="col-md-8 search">
                        <input type="text" name="search" class="form-control searcTxt" placeholder="Search"
                            value="{{ request('search') }}">

                        <button type="submit" class="btn btn-primary me-2 adduser"><i class="fas fa-search"></i>
                            Search</button>
                    </div>
                </form>


                <div class="filter-container p-4 bg-white shadow rounded">
                    <form method="GET" action="{{ route('room.index') }}" class="row g-3 filter">
                        <div class="col-md-4">
                            <input type="text" placeholder="Room Name" name="room_name" id="room_name"
                                class="form-control" value="{{ request('room_name') }}">
                        </div>

                        <div class="col-md-4">
                            <label for="status" class="form-label fw-bold">Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">All</option>
                                <option value="av">Available</option>
                                <option value="notav">Booked</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="category_id" class="form-label fw-bold">Category:</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">All</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 search">
                            <input type="number" name="min_price" id="min_price" placeholder="Min Price"
                                class="form-control num" value="{{ request('min_price') }}">
                            <input type="number" name="max_price" id="max_price" class="form-control num"
                                placeholder="Max Price" value="{{ request('max_price') }}">
                        </div>

                        <div class="col-12 text-center mt-3 search">
                            <button type="submit" class="btn btn-success px-4 apply"><i class="fas fa-filter"></i> Apply
                                Filters</button>

                            <a href="{{ route('room.index') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i>
                                Reset</a>

                        </div>
                    </form>
                </div>

            </div>


            <a href="{{ route('room.create') }}" class="btn btn-primary mb-3 adduser"
                style=" margin-bottom: 2%; margin-left: 1%">Add New Room</a>

            <div class="container mt-4">
                <div class="row">
                    @if ($rooms->isEmpty())
                        <div class="col-12 text-center">
                            <h4 style="color: #777;">There are no rooms available</h4>
                        </div>
                    @else
                        @foreach ($rooms as $room)
                            <div class="col-md-4">
                                <div class="card shadow-lg mb-4 border-primary rounded">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">
                                            {{ $room->name }}
                                        </h5>
                                        <h6 class="" style="font-size: 1.8rem; color:#777">
                                            {{ $room->price }} $
                                        </h6>
                                        <p class="card-text"><strong>Status:</strong> {{ ucfirst($room->status) }}</p>

                                        <p class="card-text"><strong>Owner:</strong> {{ $room->user->name }}</p>

                                        <div class="d-flex justify-content-center gap-2 mt-3 ">
                                            <form action="{{ route('room.destroy', $room->id) }}" method="POST"
                                                class="icons">
                                                <a href="{{ route('addimage', $room->id) }}"
                                                    class="btn btn-sm btn-outline-info iconi icongroup">
                                                    <i class="fa-solid fa-images "></i>
                                                </a>
                                                <a href="{{ route('room.edit', $room->id) }}"
                                                    class="btn btn-sm btn-outline-warning icone icongroup">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <a href="{{ route('room.show', $room->id) }}"
                                                    class="btn btn-sm btn-outline-primary iconsh icongroup">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger delete-btn icond icongroup">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>


            <div class="pagination-container">
                {{ $rooms->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection

<style>
    .page-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
    }

    .footer {
        margin-top: auto;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 10px;
        border-radius: 10px;
    }

    .pagination .page-item .page-link {
        background: #f8f9fa;
        border: 1px solid #ddd;
        color: #9282ffdd;
        border-radius: 8px;
        padding: 8px 12px;
        transition: 0.3s;
    }

    .pagination .page-item .page-link:hover {
        background-color: #9282ffdd;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: #9282ffdd;
        color: white;
        border: none;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s ease-in-out;
        border: none;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        border-radius: 10% !important
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
    }

    .card-title {

        font-size: 3rem;
        color: #9282ffdd !important
    }

    .icons {

        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3px
    }

    .icongroup {
        border-radius: 20px !important;
        padding: 10px !important;
    }

    .icone {

        border: 3px solid #343434 !important;
        background-color: #343434 !important;
        color: white !important
    }

    .icond {
        border: 3px solid #e95ecbdd !important;
        background-color: #e95ecbdd !important;
        color: white !important
    }

    .iconsh {

        border: 3px solid #9282ffdd !important;
        background-color: #9282ffdd !important;
        color: white !important
    }

    .iconi {

        border: 3px solid #b0a5f9dd !important;
        background-color: #b0a5f9dd !important;
        color: white !important
    }

    .icone:hover {

        border: 3px solid #343434 !important;
        color: #343434 !important;
        background-color: white !important
    }

    .iconi:hover {

        border: 3px solid #b0a5f9dd !important;
        color: #b0a5f9dd !important;
        background-color: white !important
    }

    .iconsh:hover {

        border: 3px solid #9282ffdd !important;
        color: #9282ffdd !important;
        background-color: white !important
    }

    .icond:hover {

        border: 3px solid #e95ecbdd !important;
        color: #e95ecbdd !important;
        background-color: white !important
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function(event) {
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
                        form.submit(); // Submits the form to perform deletion
                        Swal.fire({
                            title: "Deleted!",
                            text: "The room has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
