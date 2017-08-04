<?php

namespace App\Http\Controllers;

use Auth;
use App\Coupon;
use App\Point;
use Illuminate\Http\Request;

class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate();
        return $coupons;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        if(Auth::user()->profile->point > $coupon->point){
            $point = new Point();
            $point->user()->associate(Auth::user()->id);
            $point->type = 'Redeem';
            $point->coupon_id = $coupon->id;
            $point->point = -1 * $coupon->point;
            $point->save();
            $coupon->amount = $coupon->amount - 1;
            $coupon->save();
            return response()->json(['message'=>'coupon ' . $coupon->coupon_title.' redeemed']);
        }
        else{
            return response()->json(['message'=>'insufficient point.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
