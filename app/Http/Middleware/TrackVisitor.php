<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next ): Response {
        /*
        |--------------------------------------------------------------------------
        | Jangan tracking request yang bukan halaman web
        |--------------------------------------------------------------------------
        */

        if (! $request->isMethod('GET') || $request->ajax()) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil visitor ID dari cookie
        |--------------------------------------------------------------------------
        */

        $visitorId = $request->cookie('visitor_id');

        /*
        |--------------------------------------------------------------------------
        | Jika belum punya visitor ID, buat baru
        |--------------------------------------------------------------------------
        */

        if (! $visitorId) {
            $visitorId = (string) Str::uuid();
        }

        /*
        |--------------------------------------------------------------------------
        | Tanggal kunjungan
        |--------------------------------------------------------------------------
        */

        $today = now()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | Simpan visitor jika belum tercatat hari ini
        |--------------------------------------------------------------------------
        */

        Visitor::firstOrCreate(
            [
                'visitor_id' => $visitorId,
                'visited_date' => $today,
            ],
            [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'page' => $request->path(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Lanjutkan request
        |--------------------------------------------------------------------------
        */

        $response = $next($request);

        /*
        |--------------------------------------------------------------------------
        | Simpan cookie visitor selama 1 tahun
        |--------------------------------------------------------------------------
        */

        if (! $request->cookie('visitor_id')) {
            $response->cookie(
                'visitor_id',
                $visitorId,
                60 * 24 * 365
            );
        }

        return $response;
    }
}