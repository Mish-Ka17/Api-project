<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    public function get(string $uri, array $query = []): array
    {
        return Http::get(config('api.host') . $uri, $this->prepareQuery($query))
            ->throw()
            ->json();
    }

    private function prepareQuery(array $query): array
    {
        return array_filter(array_merge([
            'key' => config('api.token'),
        ], $query));
    }
}
