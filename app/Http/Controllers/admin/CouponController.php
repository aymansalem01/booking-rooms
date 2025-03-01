<?php

namespace App\Http\Controllers\admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(9);

        return view('admin\discounts-mangment', compact('coupons'));
    }


    public function create()
    {
        return view('admin.createcoupon');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:coupons',
            'discount' => 'required|numeric|min:1|max:100',
        ]);

        Coupon::create($request->all());


        return redirect()->route('coupon.index')->with('success', 'Coupon added successfully.');
    }


    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.editcoupon', compact('coupon'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|unique:coupons,name,',
            'discount' => 'required|numeric|min:1|max:100',
        ]);

        Coupon::find($id)->update($request->all());

        return redirect()->route('coupon.index')->with('success', 'Coupon updated successfully.');
    }


    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully.');
    }
}
