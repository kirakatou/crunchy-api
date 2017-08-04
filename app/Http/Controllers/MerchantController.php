<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use Auth;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/merchant",
     *      summary="Retrieves the collection of Merchant resources.",
     *      produces={"application/json"},
     *      tags={"Merchant"},
     *      @SWG\Response(
     *          response=200,
     *          description="Merchants collection.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/merchant")
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
        $merchants = Merchant::with("user")->paginate();
        return response()->json($merchants->toArray());
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
     *      path="/api/v1/merchant",
     *      summary="Add new Merchant.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Merchant"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Merchant has successfully added.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/merchant")
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
     *           description="Category object that needs to be added to the database", 
     *           type="string",
     *           @SWG\Schema(
     *               @SWG\Property(
     *                   property="name",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="address",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="phone_no",
     *                   type="string"
     *               )   
     *           )
     *      )              
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:255',
            'address'  => 'required|max:255',
            'phone_no' => 'required'
        ]);
        if(Auth::user()->merchant_id == null) {
            if(Auth::user()->profile_id != null) {
                $merchant = new Merchant();
                $merchant->name = $request->name;
                $merchant->address = $request->address;
                $merchant->phone_no = $request->phone_no;
                $merchant->save();
                
                $user = Auth::user()->where('id', Auth::user()->id)
                                    ->update(array('merchant_id' => $merchant->id));

                return $merchant;                    
            }else {
                return response()->json(['message' => 'Hanya user yang boleh melakukan registrasi merchant']);
            }
        }else {
            return response()->json(['message' => 'Kamu telah melakukan registrasi merchant']);
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
     *      path="/api/v1/merchant/{merchantId}",
     *      summary="Find Merchant by ID.",
     *      produces={"application/json"},
     *      tags={"Merchant"},
     *      @SWG\Response(
     *          response=200,
     *          description="This is the data that you search.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/merchant")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Merchant not found."
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
     *           name="merchantId",
     *           in="path",
     *           description="Please enter the merchantId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */
    public function show($id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->load('user');
        return $merchant;
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
     *      path="/api/v1/merchant{merchantId}",
     *      summary="Update the Merchant resource.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Merchant"},
     *      @SWG\Response(
     *          response=200,
     *          description="Merchant has been successfully updated.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/merchant")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Merchant not found."
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
     *           name="merchantId",
     *           in="path",
     *           description="Please enter the merchantId",
     *           required=true, 
     *           type="integer"
     *      ),
     *      @SWG\Parameter(
     *           name="body",
     *           in="body",
     *           required=true,
     *           description="Merchant object that needs to be updated", 
     *           type="string",
     *           @SWG\Schema(
     *               @SWG\Property(
     *                   property="name",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="address",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="phone_no",
     *                   type="string"
     *               )   
     *           )
     *      )                
     * )
     */
    public function update(Request $request, $id)
    {
        $merchant = Merchant::findOrFail($id);
        $checkUserLogin = Auth::user()->where('id', Auth::id())
                                      ->where('merchant_id', $merchant->id)
                                      ->count();
        if($checkUserLogin != 0) {
            $merchant->name = $request->name;
            $merchant->address = $request->address;
            $merchant->phone_no = $request->phone_no;
            $merchant->save();

            return $merchant;
        }else {
            return response()->json(['message' => 'Unauthorized Access'], 401);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Delete(
     *      path="/api/v1/merchant/{merchantId}",
     *      summary="Remove the Merchant resource.",
     *      produces={"application/json"},
     *      tags={"Merchant"},
     *      @SWG\Response(
     *          response=204,
     *          description="Merchant resource deleted."
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Merchant not found."
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
     *           name="merchantId",
     *           in="path",
     *           description="Please enter the merchantId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */
    public function destroy($id)
    {
        $merchant = Merchant::findOrFail($id);
        $checkUserLogin = Auth::user()->where('id', Auth::id())
                                      ->where('merchant_id', $merchant->id)
                                      ->count();
        if($checkUserLogin != 0) {
            $user = Auth::user()->where('id', Auth::id())
                                ->update(array('merchant_id' => null));
            $merchant->delete();
            
            return response()->json(['message' => 'Your merchant has been deleted'], 204);
        }else {
            return response()->json(['message' => 'Unauthorized Access'], 401);
        }
    }
}
