<?php

namespace App\Http\Controllers;

use Auth;
use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/food/coupon",
     *      summary="Retrieves the collection of Coupon resources.",
     *      produces={"application/json"},
     *      tags={"Coupon"},
     *      @SWG\Response(
     *          response=200,
     *          description="Coupons collection.",
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
     *      path="/api/v1/food/coupon",
     *      summary="Add new Coupon.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Coupon"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Coupon has successfully added.",
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
     *       @SWG\Parameter(
     *           name="body",
     *           in="body",
     *           required=true,
     *           description="Coupon object that needs to be added to the database", 
     *           type="string",
     *           @SWG\Schema(
     *               @SWG\Property(
     *                   property="coupon_title",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="point",
     *                   type="integer",
     *                   format="int32"
     *               ),
     *               @SWG\Property(
     *                   property="description",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="amount",
     *                   type="integer",
     *                   format="int32"
     *               ),  
     *           )
     *      )              
     * )
     */

    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->coupon_title = $request->coupon_title;
        $coupon->point = $request->point;
        $coupon->description = $request->description;
        $coupon->amount = $request->amount;
        $coupon->save();
        return $coupon;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/food/coupon/{id}",
     *      summary="Find Coupon by ID.",
     *      produces={"application/json"},
     *      tags={"Coupon"},
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
     *           name="id",
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

    /**
     * @SWG\Put(
     *      path="/api/v1/food/coupon/{id}",
     *      summary="Update the Coupon resource.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Coupon"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Coupon has successfully updated.",
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
     *           name="id",
     *           in="path",
     *           description="Please enter the couponId",
     *           required=true, 
     *           type="integer"
     *      ),
     *      @SWG\Parameter(
     *           name="body",
     *           in="body",
     *           required=true,
     *           description="Coupon object that needs to be added to the database", 
     *           type="string",
     *           @SWG\Schema(
     *               @SWG\Property(
     *                   property="coupon_title",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="point",
     *                   type="integer",
     *                   format="int32"
     *               ),
     *               @SWG\Property(
     *                   property="description",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="amount",
     *                   type="integer",
     *                   format="int32"
     *               )
     *           )
     *      )                
     * )
     */

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->coupon_title = $request->coupon_title;
        $coupon->point = $request->point;
        $coupon->description = $request->description;
        $coupon->amount = $request->amount;
        $coupon->save();
        return $coupon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Delete(
     *      path="/api/v1/food/coupon/{id}",
     *      summary="Remove the Coupon resource.",
     *      produces={"application/json"},
     *      tags={"Coupon"},
     *      @SWG\Response(
     *          response=204,
     *          description="Coupon resource deleted."
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Title not found."
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
     *           name="id",
     *           in="path",
     *           description="Please enter the couponId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return $coupon;
    }
}
