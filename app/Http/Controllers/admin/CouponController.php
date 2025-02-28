<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
{
    $coupons = Coupon::all();
    return view('admin.discount-mangment', compact('coupons'));
}


public function create()
{
    return view('admin.create-coupon');
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:coupons',
        'discount' => 'required|numeric|min:1|max:100',
    ]);

    Coupon::create($request->all());

    return redirect()->route('coupons.indexDiscount')->with('success', 'Coupon added successfully.');
}


public function edit(string $id)
{
    return view('admin.editCoupon', compact('coupon'));
}


public function update(Request $request, string $id)
{
    $request->validate([
        'name' => 'required|string|unique:coupons,name,',
        'discount' => 'required|numeric|min:1|max:100',
    ]);

    Coupon::find($id)->update($request->all());

    return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
}


public function destroy(string $id)
{
    Coupon::find($id)->delete();
    return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
}
}
