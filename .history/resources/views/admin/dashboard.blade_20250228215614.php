@extends('layouts.adminPage')
@section('content')
   
<div class="content">
    <div class="container-fluid">
      
    
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Rooms</h5>
                        <h3>6</h3>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>عدد الطلبات</h5>
                        <h3>{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5>عدد المستخدمين</h5>
                        <h3>{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- آخر الطلبات -->
        <div class="card mt-4">
            <div class="card-header">آخر الطلبات</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>المستخدم</th>
                            <th>الإجمالي</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>${{ $order->total }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


   @endsection