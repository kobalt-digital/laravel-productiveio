<?php

namespace Kobalt\LaravelProductiveio\Resources;

abstract class Resource
{
    protected $client;

    protected $resourceType;

    protected $endpoint;

    protected $includes = [];

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function all(?int $page = null, ?int $pageSize = null)
    {
        return $this->filter([], $page, $pageSize);
    }

    public function filter(array $filters = [], ?int $page = null, ?int $pageSize = null)
    {
        $queryParams = [];

        foreach ($filters as $field => $value) {
            if (is_array($value)) {
                $queryParams["filter[{$field}]"] = implode(',', $value);
            } else {
                $queryParams["filter[{$field}]"] = $value;
            }
        }

        if ($page !== null) {
            $queryParams['page[number]'] = $page;
        }

        if ($pageSize !== null) {
            $queryParams['page[size]'] = $pageSize;
        }

        if (! empty($this->includes)) {
            $queryParams['include'] = implode(',', $this->includes);
        }

        $response = $this->client->request()
            ->withQueryParameters($queryParams)
            ->get($this->endpoint)
            ->json();

        return [
            'data' => collect($response['data'] ?? [])->recursive(),
            'meta' => $response['meta'] ?? [],
        ];
    }

    public function find(string $id)
    {
        $queryParams = [];

        if (! empty($this->includes)) {
            $queryParams['include'] = implode(',', $this->includes);
        }

        $response = $this->client->request()
            ->withQueryParameters($queryParams)
            ->get("{$this->endpoint}/{$id}")
            ->json();

        return collect($response['data'])->recursive();
    }

    public function create(array $data)
    {
        return $this->client->request()->post($this->endpoint, [
            'data' => [
                'type' => $this->resourceType,
                'attributes' => $data,
            ],
        ])->json();
    }

    public function update(string $id, array $data)
    {
        return $this->client->request()->patch("{$this->endpoint}/{$id}", [
            'data' => [
                'type' => $this->resourceType,
                'id' => $id,
                'attributes' => $data,
            ],
        ])->json();
    }

    public function delete(string $id)
    {
        return $this->client->request()->delete("{$this->endpoint}/{$id}")->json();
    }

    public function include(array $includes)
    {
        $this->includes = $includes;

        return $this;
    }
}
