@extends('layouts.adminPage')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2 style="color: #777" class="text-center text-purple fw-bold">Coupons Management</h2>

    <div class="text-end mb-3">
        <a class="btn btn-primary add-coupon adduser" href="{{ route('coupon.create') }}">
            <i class="fas fa-user-plus"></i> Add Coupon</a>
        
    </div>
       
        <div class="row justify-content-center" style="gap: 20px;">
            @if($coupons->isNotEmpty())  
                @foreach ($coupons as $coupon)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="review-card">
                            <h5 class="user-name">{{ $coupon->name }}</h5>
                            <p class="user-rating">Discount: {{ $coupon->discount }}%</p>
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
        color: rgb(70, 70, 70);
    }

    .edit-btn:hover {
        color: rgb(55, 55, 55);
    }

    .delete-btn {
        color: #9282ffdd
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

    .add-coupon {
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
