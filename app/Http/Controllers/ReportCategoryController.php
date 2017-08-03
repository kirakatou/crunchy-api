<?php

namespace App\Http\Controllers;

use Auth;
use App\ReportCategory;
use Illuminate\Http\Request;

class ReportCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/food/reportcategory",
     *      summary="Retrieves the collection of Report Category resources.",
     *      produces={"application/json"},
     *      tags={"ReportCategory"},
     *      @SWG\Response(
     *          response=200,
     *          description="Report Categories collection.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/reportcategory")
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
        $reports = ReportCategory::paginate();
        return $reports;
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
     *      path="/api/v1/food/reportcategory",
     *      summary="Add new Report Category.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"ReportCategory"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Report Category has successfully added.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/reportcategory")
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
     *           description="Report Category object that needs to be added to the database", 
     *           type="string",
     *           @SWG\Schema(
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
        $report = new ReportCategory();
        $report->name = $request->name;
        $report->save();
        return $report;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *      path="/api/v1/food/reportcategory/{id}",
     *      summary="Find Report Category by ID.",
     *      produces={"application/json"},
     *      tags={"ReportCategory"},
     *      @SWG\Response(
     *          response=200,
     *          description="This is the data that you search.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/reportcategory")
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
     *          description="Report Category not found."
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
     *           description="Please enter the reportcategoryId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */

    public function show($id)
    {
        $report = ReportCategory::findOrFail($id);
        if(empty($report)){
            return response()->json(['message' => 'Report Category ID not found'], 404);
        }
        return response()->json($report);
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
     *      path="/api/v1/food/reportcategory/{id}",
     *      summary="Update the Report Category resource.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"ReportCategory"},
     *      @SWG\Response(
     *          response=200,
     *          description="new Report Category has successfully updated.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/reportcategory")
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
     *          description="Report Category not found."
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
     *           description="Please enter the categoryreportId",
     *           required=true, 
     *           type="integer"
     *      ),
     *      @SWG\Parameter(
     *           name="body",
     *           in="body",
     *           required=true,
     *           description="Report Category object that needs to be added to the database", 
     *           type="string",
     *           @SWG\Schema(
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
        $report = ReportCategory::findOrFail($id);
        $report->name = $request->name;
        $report->save();
        return $report;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Delete(
     *      path="/api/v1/food/reportcategory/{id}",
     *      summary="Remove the Report Category resource.",
     *      produces={"application/json"},
     *      tags={"ReportCategory"},
     *      @SWG\Response(
     *          response=204,
     *          description="Report Category resource deleted."
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="Report Category not found."
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
     *           description="Please enter the reportcategoryId",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */

    public function destroy($id)
    {
        $report = ReportCategory::findOrFail($id);
        $report->delete();
        return $report;
    }
}
