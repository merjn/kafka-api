<?php

namespace App\Presentation\Exceptions;

use App\Application\Usecases\User\Command\CreateAccount\Exceptions\CreateAccountValidationException;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions\DuplicateEmailException;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions\DuplicateUsernameException;
use App\Application\Usecases\User\Command\CreateAccount\Interceptors\Exceptions\ReachedIpLimitException;
use App\Http\Resources\ApiErrorResource;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    protected $dontReport = [
        ReachedIpLimitException::class,
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->createRenderableForUser();
        $this->reportable(function (Throwable $e) {

        });
    }

    private function createRenderableForUser()
    {
        $this->renderable(function (CreateAccountValidationException $exception) {
            return new ApiErrorResource($exception);
        });

        $this->renderable(function (DuplicateEmailException|DuplicateUsernameException|ReachedIpLimitException $exception) {
            return new ApiErrorResource($exception);
        });
    }
}
