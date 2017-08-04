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

    /**
     * @SWG\Get(
     *      path="/api/v1/redeem",
     *      summary="Retrieves the collection of Coupon resources for redeem.",
     *      produces={"application/json"},
     *      tags={"Redeem"},
     *      @SWG\Response(
     *          response=200,
     *          description="Coupons collection for redeem.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/coupon")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="Example = Bearer(space)'your_token'",
     *          in="header",
     *          required=true,
     *          type="string",
     *          default="Bearer" 
     *      )    
     * )
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

    /**
     * @SWG\Post(
     *      path="/api/v1/redeem/{coupon_id}",
     *      summary="Redeem a coupon.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Redeem"},
     *      @SWG\Response(
     *          response=200,
     *          description="coupon *coupon's name* redeemed.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/coupon")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="Example = Bearer(space)'your_token'",
     *          in="header",
     *          required=true,
     *          type="string",
     *          default="Bearer",
     *      ),
     *      @SWG\Parameter(
     *           name="coupon_id",
     *           in="path",
     *           description="Please enter the couponId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
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

    /**
     * @SWG\Get(
     *      path="/api/v1/redeem/{coupon_id}",
     *      summary="Find Coupon by ID.",
     *      produces={"application/json"},
     *      tags={"Redeem"},
     *      @SWG\Response(
     *          response=200,
     *          description="This is the data that you search.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/coupon")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=400,
     *          description="Invalid ID."
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Coupon not found."
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="Example = Bearer(space)'your_token'",
     *          in="header",
     *          required=true,
     *          type="string",
     *          default="Bearer",
     *      ),
     *      @SWG\Parameter(
     *           name="coupon_id",
     *           in="path",
     *           description="Please enter the couponId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        if(empty($coupon)){
            return response()->json(['message' => 'Coupon ID not found'], 404);
        }
        return response()->json($coupon);
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
