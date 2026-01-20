<?php

namespace Kobalt\LaravelProductiveio;

use Illuminate\Support\Facades\Http;
use Kobalt\LaravelProductiveio\Resources\Bookings;
use Kobalt\LaravelProductiveio\Resources\Budgets;
use Kobalt\LaravelProductiveio\Resources\Companies;
use Kobalt\LaravelProductiveio\Resources\Contacts;
use Kobalt\LaravelProductiveio\Resources\Deals;
use Kobalt\LaravelProductiveio\Resources\People;
use Kobalt\LaravelProductiveio\Resources\Projects;
use Kobalt\LaravelProductiveio\Resources\Roles;
use Kobalt\LaravelProductiveio\Resources\Tasks;
use Kobalt\LaravelProductiveio\Resources\TimeEntries;

class LaravelProductiveio
{
    protected $apiToken;

    protected $organizationId;

    protected $baseUrl = 'https://api.productive.io/api/v2';

    protected $bookings;

    protected $budgets;

    protected $companies;

    protected $contacts;

    protected $deals;

    protected $people;

    protected $projects;

    protected $roles;

    protected $tasks;

    protected $timeEntries;

    public function __construct(?string $apiToken = null, ?string $organizationId = null)
    {
        $this->apiToken = $apiToken ?? config('productiveio.api_token');
        $this->organizationId = $organizationId ?? config('productiveio.organization_id');

        if (empty($this->apiToken) || empty($this->organizationId)) {
            throw new \InvalidArgumentException('Productive API token and organization ID are required.');
        }

        $this->bookings = new Bookings($this);
        $this->budgets = new Budgets($this);
        $this->companies = new Companies($this);
        $this->contacts = new Contacts($this);
        $this->deals = new Deals($this);
        $this->people = new People($this);
        $this->projects = new Projects($this);
        $this->roles = new Roles($this);
        $this->tasks = new Tasks($this);
        $this->timeEntries = new TimeEntries($this);
    }

    public function request()
    {
        return Http::withHeaders([
            'X-Auth-Token' => $this->apiToken,
            'X-Organization-Id' => $this->organizationId,
            'Content-Type' => 'application/vnd.api+json',
        ])->baseUrl($this->baseUrl);
    }

    public function bookings()
    {
        return $this->bookings;
    }

    public function budgets()
    {
        return $this->budgets;
    }

    public function companies()
    {
        return $this->companies;
    }

    public function contacts()
    {
        return $this->contacts;
    }

    public function deals()
    {
        return $this->deals;
    }

    public function people()
    {
        return $this->people;
    }

    public function projects()
    {
        return $this->projects;
    }

    public function roles()
    {
        return $this->roles;
    }

    public function tasks()
    {
        return $this->tasks;
    }

    public function timeEntries()
    {
        return $this->timeEntries;
    }
}
