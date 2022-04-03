<?php

namespace App\Services;

use App\Models\Analytics;
use App\Repositories\AnalyticsRepository;

class AnalyticsService {

    /**
     * @var AnalyticsRepository
     */
    private $repository;

    /**
     * @param  AnalyticsRepository  $analyticsRepository
     */
    public function __construct(AnalyticsRepository $analyticsRepository)
    {
        $this->repository = $analyticsRepository;
    }

    /**
     * @param  float   $amount
     * @param  string  $object
     * @param  string  $action
     * @param $objectId
     *
     * @return Analytics
     */
    public function create(float $amount, string $object, string $action, $objectId = null): Analytics
    {
        $data['object'] = $object;
        $data['action'] = $action;
        $data['amount'] = $amount;
        $data['object_id'] = $objectId;

        return $this->repository->create($data);
    }
}
