<?php

namespace Kobalt\LaravelProductiveio\Resources;

class People extends Resource
{
    protected $resourceType = 'people';
    protected $endpoint = '/people';

    public function invite(array $data)
    {
        return $this->client->request()->post("{$this->endpoint}/invite", [
            'data' => [
                'type' => $this->resourceType,
                'attributes' => $data
            ]
        ])->json();
    }

    public function reinvite(string $id)
    {
        return $this->client->request()->post("{$this->endpoint}/{$id}/reinvite", [
            'data' => [
                'type' => $this->resourceType,
                'id' => $id
            ]
        ])->json();
    }

    public function deactivate(string $id)
    {
        return $this->client->request()->patch("{$this->endpoint}/{$id}/deactivate", [
            'data' => [
                'type' => $this->resourceType,
                'id' => $id
            ]
        ])->json();
    }
}