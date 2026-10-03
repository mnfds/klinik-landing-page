<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SiklinikApi
{
    private function client(): PendingRequest
    {
        return Http::baseUrl(config('services.siklinik.url'))
            ->withHeaders([
                'X-Api-Key' => config('services.siklinik.key'),
                'X-Client-Ip' => request()->ip(),
            ])
            ->acceptJson()
            ->timeout(8);
    }

    public function poliklinik(): array
    {
        return Cache::remember('siklinik.poliklinik', 600, fn () =>
            $this->client()->get('/reservasi/poliklinik')->throw()->json('data')
        );
    }

    public function dokter(int $poliId): array
    {
        return Cache::remember("siklinik.dokter.$poliId", 600, fn () =>
            $this->client()->get('/reservasi/dokter', ['poli_id' => $poliId])->throw()->json('data')
        );
    }

    public function kirimReservasi(array $data): Response
    {
        return $this->client()->post('/reservasi', $data);
    }
}