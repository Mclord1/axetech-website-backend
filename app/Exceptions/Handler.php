<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Handle authentication exceptions
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated.',
                    'data' => null
                ], 401);
            }
        });

        // Handle validation exceptions
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'data' => null,
                    'errors' => $e->errors()
                ], 422);
            }
        });

        // Handle model not found exceptions
        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found.',
                    'data' => null
                ], 404);
            }
        });

        // Handle route not found exceptions
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested endpoint was not found.',
                    'data' => null
                ], 404);
            }
        });

        // Handle method not allowed exceptions
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'The requested method is not allowed for this endpoint.',
                    'data' => null
                ], 405);
            }
        });

        // Handle database query exceptions
        $this->renderable(function (QueryException $e, $request) {
            if ($request->is('api/*')) {
                // Log the actual error for debugging
                logger()->error('Database error: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => 'A database error occurred.',
                    'data' => null
                ], 500);
            }
        });

        // Handle all other exceptions
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                // Log the actual error for debugging
                logger()->error('Unexpected error: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => 'An unexpected error occurred.',
                    'data' => null
                ], 500);
            }
        });
    }
}