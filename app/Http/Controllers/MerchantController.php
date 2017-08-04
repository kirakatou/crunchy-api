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
