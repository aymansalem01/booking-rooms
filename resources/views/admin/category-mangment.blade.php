@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777" class="text-center text-purple fw-bold">Categories Management</h2>
        <div class="text-end mb-3">
            <a class="btn  adduser" href="{{ route('category.create') }}">
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
                                <a href="{{ route('category.edit', parameters: $category->id) }} " class="edit-btn"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 text-center mt-4">
                    {{ $categories->links() }}
                </div>
            @else
                <p class="no-reviews">No categories available!</p>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
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
        color: green;
    }

    .edit-btn:hover {
        color: darkgreen;
    }

    .delete-btn {
        color: red;
    }

    .delete-btn:hover {
        color: darkred;
    }

    .no-reviews {
        text-align: center;
        font-size: 1.2em;
        color: #777;
        margin-top: 20px;
    }

    .add-category {
        display: block;
        text-align: center;
        font-size: 1.2em;
        font-weight: bold;
        color: #B197FC;
        margin-bottom: 20px;
        cursor: pointer;
    }
    .adduser:hover{
   
   border:1px solid #9282ffdd !important;
   color: #9282ffdd !important;
   background-color: white !important
}
.adduser{
  
   background-color: #9282ffdd !important;
   border:1px solid #9282ffdd !important;
   color: white !important;
   width: 20%;
   margin-left: 20px
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
                            text: "The review has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
