<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use App\Traits\ApiResponser;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;

class Handler extends ExceptionHandler
{
    use ApiResponser;




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

        // ValidationException- Mostrar Errores de Validacion
        $this->renderable(function (ValidationException $e, $request) {
            $errors = $e->validator->errors()->getMessages();
            return $this->errorResponse($errors, 422);
        });

        // ModelNotFoundException- Mostrar Errores de Modelos no encontrados
        $this->renderable(function (ModelNotFoundException $exception) {
            $modelo = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ninguna instancia de {$modelo} con el id especificado", 404);
        });

        // AuthenticationException- Mostrar Errores de Autenticacion
        $this->renderable(function (AuthenticationException $exception, $request) {
            return $this->errorResponse('No autenticado.', 401);    
        }); 
       
        // AuthorizationException- Mostrar Errores de Autorizacion
        $this->renderable(function (AuthorizationException $exception) {
            return $this->errorResponse('No posee permisos para ejecutar esta acción', 403);
        });

        // NotFoundHttpException- Mostrar Errores de Rutas no encontradas
        $this->renderable(function (NotFoundHttpException $exception) {
            return $this->errorResponse('No se encontró la URL especificada', 404);
        });

        // MethodNotAllowedHttpException- Mostrar Errores de Metodos no encontrados
        $this->renderable(function (MethodNotAllowedHttpException $exception) {
            return $this->errorResponse('El método especificado en la petición no es válido', 405);
        });


        // HttpException- Mostrar Errores de Excepciones
        $this->renderable(function (HttpException $exception) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        });

        // QueryException- Mostrar Errores de Consultas a la Base de Datos
        $this->renderable(function (QueryException $exception) {
            $codigo = $exception->errorInfo[1];

            if ($codigo == 1451) {
                return $this->errorResponse('No se puede eliminar de forma permamente el recurso porque está relacionado con algún otro.', 409);
            }
        });

    }

}
