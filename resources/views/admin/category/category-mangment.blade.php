@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
      

        <h2 style="color: #777" class="text-center text-purple fw-bold">Categories Management</h2>
        <form method="GET" action="{{ route('admin.search') }}">
            <div class="search-container">
                <input type="text" name="query" class="form-control search-input" placeholder="Search categories..." value="{{ request('query') }}">
                <input type="hidden" name="page" value="categories">
                <button type="submit" class="btn btn-primary mt-2 search-btn">Search</button>
            </div>
        </form>
        <div class="text-end mb-3">
            <a class="btn adduser" href="{{ route('adcategory.create') }}">
                <i class="fas fa-user-plus"></i> Add Category
            </a>
        </div>

        <div class="row justify-content-center" style="gap: 20px;">
            @if($categories->isNotEmpty())
                @foreach ($categories as $category)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            <h5 class="category-name">Category Name: {{ $category->name }}</h5>
                            <p>{{ $category->text }}</p>
                            <div class="action-buttons">
                                <a href="{{ route('adcategory.edit', parameters: $category->id) }} " class="edit-btn"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('adcategory.destroy', $category->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="no-reviews">No categories available!</p>
            @endif
        </div>

        <div class="pagination-container">
            {{ $categories->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

<style>
    /* Existing Styles for the Category Cards */
    .review-card {
        width: 80%;
        max-width: 350px;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.3s ease-in-out;
        margin: 20px;
    }

    .review-card:hover {
        transform: translateY(-5px);
    }

    .category-name {
        font-size: 1.1em;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .view-btn, .edit-btn, .delete-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .view-btn {
        color: #B197FC;
    }

    .view-btn:hover {
        color: #8c6efc;
    }

    .edit-btn {
        color: rgb(60, 60, 60);
    }

    .edit-btn:hover {
        color: rgb(40, 41, 40);
    }

    .delete-btn {
        color: #9282ffdd;
    }

    .delete-btn:hover {
        color: #8c6efc;
    }

    .no-reviews {
        text-align: center;
        font-size: 1.2em;
        color: #777;
        margin-top: 20px;
    }

    /* Styling for Add Category Button */
    .add-category {
        display: block;
        text-align: center;
        font-size: 1.2em;
        font-weight: bold;
        color: #B197FC;
        margin-bottom: 20px;
        cursor: pointer;
    }

    .adduser:hover {
        border:1px solid #9282ffdd !important;
        color: #9282ffdd !important;
        background-color: white !important
    }

    .adduser {
        background-color: #9282ffdd !important;
        border:1px solid #9282ffdd !important;
        color: white !important;
        width: 20%;
        margin-left: 20px
    }

    /* Search form styles */
    .search-container {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }

    .search-input {
        width: 300px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 1em;
    }

    .search-btn {
        background-color: #9282ffdd;
        border: 1px solid #9282ffdd;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-btn:hover {
        background-color: #8c6efc;
    }

    /* Pagination Styles */
    .pagination-container {
        display: flex;
        justify-content: center;
        gap: 10px;
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
</style>

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
                            text: "The category has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
