<?php

namespace App\Exceptions;

use App\Shared\util\Res;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $exceptionName = (new \ReflectionClass($exception))->getShortName();

        // Rota não encontrada
        if ($exceptionName === 'NotFoundHttpException') {
            return Res::error(
                trans('message_lang.not_found_route_http'),
                Response::HTTP_NOT_FOUND,
                $exceptionName,
            );
        }

        // Rota não encontrada
        if ($exceptionName === 'RouteNotFoundException') {
            return Res::error(
                trans('message_lang.route_not_found_or_token_invalid'),
                Response::HTTP_NOT_FOUND,
                $exceptionName,
            );
        }

        // Model não encontrado
        if ($exceptionName === 'ModelNotFoundException') {
            return Res::error(
                null,
                $exception->status(),
                $exception->errors(),
            );
        }
        
        // Validação dos dados
        if ($exceptionName === 'ValidationException') {
            return Res::error(
                $exception->errors(),
                $exception->status,
                $exceptionName,
            );
        }

        // Erro de query
        if ($exceptionName === 'QueryException') {
            return Res::error(
                $exception->getMessage(),
                Response::HTTP_BAD_REQUEST,
                $exceptionName,
            );
        }

        // Caso nenhuma exceção seja executada acima.
        return Res::error(
            $exception->getMessage(),
            Response::HTTP_BAD_REQUEST,
            "Unexpected exception [${exceptionName}]",
        );
    }    
}
