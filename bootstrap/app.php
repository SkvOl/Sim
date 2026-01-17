<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => null); 
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $th) {
            $code = $th->getCode() === 0 ? 500 : $th->getCode();
            
            $statusCode = method_exists($th, 'getStatusCode') ? $th->getStatusCode() : $code;
            
            $response = ['Message' => $th->getMessage()];

            if(!is_null(request()->user()) AND request()->user()->is_admin === 1){
                $response+= [ 'Info' => [
                    // 'trace'=>$th->getTrace(),
                    'line' => $th->getLine(),
                    'file' => $th->getFile(),
                ]];
            }
            
            return Response::response($response, $statusCode);
        });
    })->create();
