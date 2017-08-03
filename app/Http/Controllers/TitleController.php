<?php

namespace App\Http\Controllers;

use Auth;
use App\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/food/title",
     *      summary="Retrieves the collection of Title resources.",
     *      produces={"application/json"},
     *      tags={"Title"},
     *      @SWG\Response(
     *          response=200,
     *          description="Titles collection.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/title")
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
        $titles = Title::paginate();
        return $titles;
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
     *      path="/api/v1/food/title",
     *      summary="Add new Title.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Title"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Title has successfully added.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/title")
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
     *           description="Title object that needs to be added to the database", 
     *           type="string",
     *           @SWG\Schema(
     *               @SWG\Property(
     *                   property="level",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="name",
     *                   type="string"
     *               )   
     *           )
     *      )              
     * )
     */

    public function store(Request $request)
    {
        $title = new Title();
        $title->level = $request->level;
        $title->name = $request->name;
        $title->save();
        return $title;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/food/title/{id}",
     *      summary="Find Title by ID.",
     *      produces={"application/json"},
     *      tags={"Title"},
     *      @SWG\Response(
     *          response=200,
     *          description="This is the data that you search.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/title")
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
     *           description="Please enter the titleId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */

    public function show($id)
    {
        $title = Title::findOrFail($id);
        if(empty($title)){
            return response()->json(['message' => 'Title ID not found'], 404);
        }
        return response()->json($title);
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
     *      path="/api/v1/food/title/{id}",
     *      summary="Update the Title resource.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Title"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Title has successfully updated.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/title")
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
     *           description="Please enter the titleId",
     *           required=true, 
     *           type="integer"
     *      ),
     *      @SWG\Parameter(
     *           name="body",
     *           in="body",
     *           required=true,
     *           description="Title object that needs to be added to the database", 
     *           type="string",
     *           @SWG\Schema(
     *               @SWG\Property(
     *                   property="level",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="name",
     *                   type="string"
     *               )   
     *           )
     *      )                
     * )
     */

    public function update(Request $request, $id)
    {
        $title = Title::findOrFail($id);
        $title->level = $request->level;
        $title->name = $request->name;
        $title->save();
        return $title;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Delete(
     *      path="/api/v1/food/title/{id}",
     *      summary="Remove the Title resource.",
     *      produces={"application/json"},
     *      tags={"Title"},
     *      @SWG\Response(
     *          response=204,
     *          description="Title resource deleted."
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
     *           description="Please enter the titleId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */

    public function destroy($id)
    {
        $title = Title::findOrFail($id);
        $title->delete();
        return $title;
    }
}
