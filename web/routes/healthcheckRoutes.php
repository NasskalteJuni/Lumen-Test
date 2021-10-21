<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Todo;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

function databaseIsOnline(){
    try{
        DB::getPdo();
    }catch (Exception $e){
        return false;
    }
    return true;
}

$router->get("/healthcheck", function(Request $request, Response $response) use ($router){

    $content = array(
        "version" => $router->app->version(),
        "time" => date("c"),
        "db" => array(
            "database" => DB::connection()->getDatabaseName() ?: "(not configured)",
            "status" => databaseIsOnline() ? "online" : "offline"
        )
    );

    return $response
        ->setStatusCode(200)
        ->setContent($content);
});


$router->post("/healthcheck" , function(){
    return "healthcheck";
});




