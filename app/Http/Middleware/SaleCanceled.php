<?php

namespace App\Http\Middleware;

use App\Models\Sale;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleCanceled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sale = Sale::find($request->id);

        if ($sale->status === 'CANCELADO') {
            return abort(403, 'Sale canceled');
        }

        if ($sale->status === 'REEMBOLSADO') {
            return abort(403, 'Sale refunded');
        }

        return $next($request);
    }
}
