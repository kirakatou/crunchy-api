<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/category",
     *      summary="Retrieves the collection of Category resources.",
     *      produces={"application/json"},
     *      tags={"Category"},
     *      @SWG\Response(
     *          response=200,
     *          description="Categories collection.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/category")
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
        $categories = Category::paginate();
        return $categories;
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
     *      path="/api/v1/category",
     *      summary="Add new Category.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Category"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Category has successfully added.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/category")
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
     *                   property="icon",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="category",
     *                   type="boolean"
     *               )   
     *           )
     *      )              
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|unique:categories',
            'icon'      => 'required|unique:categories',
            'category'  => 'required'
            ]);

        $category = new Category();
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->category = $request->category;
        $category->save();
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/category/{id}",
     *      summary="Find Category by ID.",
     *      produces={"application/json"},
     *      tags={"Category"},
     *      @SWG\Response(
     *          response=200,
     *          description="This is the data that you search.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/category")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=400,
     *          description="Invalid ID."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Category not found."
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
     *           required=true, 
     *           type="integer",
     *           format="int32"
     *      )              
     * )
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $category;
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
     *      path="/api/v1/category/{id}",
     *      summary="Update Category.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"Category"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Category has successfully updated.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/category")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=400,
     *          description="Invalid ID."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Category not found."
     *      ),
     *      @SWG\Response(
     *          response=405,
     *          description="Validation exception."
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
     *           required=true, 
     *           type="integer",
     *           format="int32"
     *      ),
     *      @SWG\Parameter(
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
     *                   property="icon",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="category",
     *                   type="boolean"
     *               )   
     *           )
     *      )                
     * )
     */

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->category = $request->category;
        $category->save();
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }
}
