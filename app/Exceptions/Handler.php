<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $throwable)
    {
        if ($throwable instanceof ValidationException) {
            $errors = $throwable->errors();

            $firstErrorKey = array_keys($errors)[0];
            $firstErrorMessage = array_values($errors)[0][0];

            return response()->json([
                'errors' => [
                   $firstErrorKey => $firstErrorMessage,
                ],
                'code' => $throwable->status,
            ], $throwable->status);
        } elseif ($throwable instanceof ModelNotFoundException) {
            return response()->json([
                'errors' => [
                    __('content.errors.not_found')
                ],
                'code' => HTTP_STATUS_CODE_NOT_FOUND,
            ], HTTP_STATUS_CODE_NOT_FOUND);
        }

        return parent::render($request, $throwable);
    }
}