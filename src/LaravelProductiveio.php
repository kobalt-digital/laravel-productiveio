<?php

namespace Kobalt\LaravelProductiveio;

use Illuminate\Support\Facades\Http;
use Kobalt\LaravelProductiveio\Resources\Companies;
use Kobalt\LaravelProductiveio\Resources\Contacts;
use Kobalt\LaravelProductiveio\Resources\People;
use Kobalt\LaravelProductiveio\Resources\Projects;

class LaravelProductiveio
{
    protected $apiToken;

    protected $organizationId;

    protected $baseUrl = 'https://api.productive.io/api/v2';

    protected $companies;

    protected $contacts;

    protected $people;

    protected $projects;

    public function __construct(?string $apiToken = null, ?string $organizationId = null)
    {
        $this->apiToken = $apiToken ?? config('productiveio.api_token');
        $this->organizationId = $organizationId ?? config('productiveio.organization_id');

        $this->companies = new Companies($this);
        $this->contacts = new Contacts($this);
        $this->people = new People($this);
        $this->projects = new Projects($this);
    }

    public function request()
    {
        return Http::withHeaders([
            'X-Auth-Token' => $this->apiToken,
            'X-Organization-Id' => $this->organizationId,
            'Content-Type' => 'application/vnd.api+json',
        ])->baseUrl($this->baseUrl);
    }

    public function companies()
    {
        return $this->companies;
    }

    public function contacts()
    {
        return $this->contacts;
    }

    public function people()
    {
        return $this->people;
    }

    public function projects()
    {
        return $this->projects;
    }
}
