<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Todo;
use Illuminate\Support\Facades\Log;


$router->get("todos/", function(Request $request, Response $response){
    $todos = Todo::query()->where("user", "abc");

    if($request->get("limit", false)) $todos = $todos->take($request->get("limit"));
    if($request->get("offset", false)) $todos = $todos->skip($request->get("offset"));

    return $response->setStatusCode(200)->setContent(json_encode($todos->get()));

});

$router->get("todos/{todo}", function(Request $request, Response $response, Todo $todo){
    Log:error("Get called");
    return $todo;
    if($todo->user != $request->user()->id) return $response->setStatusCode(403)->setContent(array("error" => "access not allowed for user"));

    return $todo;
});

$router->post("todos/", function(Request $request, Response $response) {

    $this->validate($request, array(
        "title" => "required|string|max:100",
        "description" => "string|max:1000",
        "done" => "boolean"
    ));

    $todo = new Todo(array(
        "title" => $request->get("title"),
        "description" => $request->get("description", ""),
        "done" => $request->get("done", false)
    ));

    $todo->save();

    return $response
        ->setStatusCode(201)
        ->header("Location", $request->route()->uri . $todo->id)
        ->setContent($todo);
});

$router->put("todos/{todo}", function(Request $request, Response $response, Todo $todo){
    $request->validate(array(
        "title" => "required|string|max:100",
        "description" => "required|string|max:1000",
        "done" => "required|boolean"
    ));

    $todo->update(array(
        "title" => $request->get("title"),
        "description" => $request->get("description"),
        "done" => $request->get("done")
    ));

    return $response->setStatusCode(200)->setContent(array("message" => "updated"));
});

$router->delete("/{todo}", function(Request $request, Response $response, Todo $todo){
    if($todo->user != $request->user()->id) return $response->setStatusCode(403)->setContent(array("error" => "access not allowed for user"));

    $todo->delete();

    return $response->setStatusCode(200)->statusContent(array("message" => "deleted"));
});


