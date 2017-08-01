<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

	/**
     * @SWG\Swagger(
     *   basePath="",
     *   host="crunchy-api.dev",
     *   schemes={"http"},
     *   @SWG\Info(
     *       version="1.0",
     *       title="Crunchy API",
     *       description="This is a sample of Crunchy API",
     *       @SWG\Contact(
     *           name="SmallCorridor",
     *           email="smallcorridor@gmail.com"
     *       ),
     *   ),
     *   @SWG\Definition(
     *       definition="Error",
     *       required={"code", "message"},
     *       @SWG\Property(
     *           property="code",
     *           type="integer",
     *           format="int32"
     *       ),
     *       @SWG\Property(
     *           property="message",
     *           type="string"
     *       )
     *   )
     * )
     */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
