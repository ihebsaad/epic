<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
 
/**
 * @SWG\Swagger(
 *     basePath="",
 *     schemes={"http", "https"},
 *     host="http://mysaamp.com/myapi/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="API Saamp",
 *         description="Documentation pour l'API de SAAMP  ",
 *         @SWG\Contact(
 *             email="ihebsaad@gmail.com"
 *         ),
 *     )
 * )
 */
 
 
 
 
 /**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Saamp",
 *         description="Documentation pour l'API de SAAMP  ",
 *      @OA\Contact(
 *          email="ihebsaad@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 *  @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="L5 Swagger OpenApi dynamic host server"
 *  )
 *
 */
 
 
 
 
 /**
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     description="Use a global client_id / client_secret and your username / password combo to obtain a token",
 *     name="passwords",
 *     in="header",
 *     scheme="https",
 *     securityScheme="passwords",
 *     @OA\Flow(
 *         flow="password",
 *         authorizationUrl="/myapi/oauth/authorize",
 *         tokenUrl="/myapi/oauth/token",
 *         refreshUrl="/oauth/token/refresh",
 *      scopes={}
 *     )
 * )
 */

/**
 * @OA\OpenApi(
 *   security={
 *     {
 *       "oauth2": {"read:oauth2"},
 *     }
 *   }
 * )
 */
 
 
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}