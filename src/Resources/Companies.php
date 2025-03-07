<?php

namespace Kobalt\LaravelProductiveio\Resources;

class Companies extends Resource
{
    protected $resourceType = 'companies';
    protected $endpoint = '/companies';

    public function restore(string $id)
    {
        return $this->client->request()->patch("{$this->endpoint}/{$id}/restore", [
            'data' => [
                'type' => $this->resourceType,
                'id' => $id
            ]
        ])->json();
    }
}