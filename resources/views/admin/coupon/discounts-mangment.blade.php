@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777" class="text-center text-purple fw-bold">Coupons Management</h2>

        <div class="filter-box">
            <form method="GET" action="{{ route('admin.search') }}" class="filter-form">
                <input type="hidden" name="page" value="coupons">

                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="query" class="form-control" placeholder="Search by name..." value="{{ request('query') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="min_discount" class="form-control" placeholder="Min Discount (%)" value="{{ request('min_discount') }}" min="0">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="max_discount" class="form-control" placeholder="Max Discount (%)" value="{{ request('max_discount') }}" max="100">
                    </div>
                    <div class="col-md-2">
                        <select name="sort_by_discount" class="form-control">
                            <option value="">Sort by Discount</option>
                            <option value="asc" {{ request('sort_by_discount') == 'asc' ? 'selected' : '' }}>Low to High</option>
                            <option value="desc" {{ request('sort_by_discount') == 'desc' ? 'selected' : '' }}>High to Low</option>
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="text-end mb-3">
            <a class="btn btn-primary add-coupon adduser" href="{{ route('coupon.create') }}">
                <i class="fas fa-user-plus"></i> Add Coupon
            </a>
        </div>

        <div class="row justify-content-center" style="gap: 20px;">
            @if($coupons->isNotEmpty())  
                @foreach ($coupons as $coupon)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            <h5 class="user-name">{{ $coupon->name }}</h5>
                            <p class="user-rating">Discount: <span class="discount-value">{{ $coupon->discount }}%</span></p>
                            <div class="action-buttons">
                                <a href="{{ route('coupon.edit', $coupon->id) }}" class="edit-btn"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 text-center mt-4">
                    {{ $coupons->links() }}
                </div>
            @else
                <p class="no-reviews">No coupons available!</p>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
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

    .review-card {
        width: 100%;
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

    .user-name {
        font-size: 1.1em;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .user-rating {
        font-size: 1.2em;
        color: #B197FC;
        font-weight: bold;
    }

    .discount-value {
        font-weight: bold;
        color: #28a745;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .edit-btn, .delete-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .edit-btn {
        color: rgb(70, 70, 70);
    }

    .edit-btn:hover {
        color: rgb(55, 55, 55);
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

    .adduser {
        background-color: #9282ffdd !important;
        border: 1px solid #9282ffdd !important;
        color: white !important;
        width: 20%;
        margin-left: 20px;
    }

    .adduser:hover {
        border: 1px solid #9282ffdd !important;
        color: #9282ffdd !important;
        background-color: white !important;
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
                            text: "The coupon has been deleted.",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
