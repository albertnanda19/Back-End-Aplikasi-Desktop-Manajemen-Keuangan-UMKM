<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use App\Helpers\ResponseHelper;

class JsonResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $firstError = array_values($errors)[0][0];

            return ResponseHelper::createResponse(400, $firstError, null);
        } catch (NotFoundHttpException $e) {
            return ResponseHelper::createResponse(
                404,
                "Halaman tidak ditemukan",
                null
            );
        } catch (MethodNotAllowedHttpException $e) {
            return ResponseHelper::createResponse(
                405,
                "Metode HTTP tidak diizinkan",
                null
            );
        } catch (Throwable $e) {
            return ResponseHelper::createResponse(
                500,
                "Terjadi kesalahan pada server",
                $e->getMessage()
            );
        }
    }
}
