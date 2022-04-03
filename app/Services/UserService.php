<?php

namespace App\Services;

use App\Models\Analytics;
use App\Models\User;
use App\Repositories\AnalyticsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService {

    /**
     * @var AnalyticsService
     */
    private $analyticsService;

    /**
     * @param  AnalyticsService  $analyticsService
     */
    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    /**
     * @param  float  $sum
     *
     * @return mixed|string[]
     */
    public function addMoney(float $sum)
    {
        $user = Auth::user();

        try {
            DB::beginTransaction();

            $user->addBalance($sum);
            $this->analyticsService->create(
                $sum,
                Analytics::TRANSACTION_TYPE_WALLET,
                Analytics::ACTION_TYPE_ADD_MONEY
            );

            DB::commit();

            return ['balance' => $user->wallet_balance];

        } catch (\Throwable $e) {
            DB::rollback();

            return ['error' => 'Server error'];
        }
    }
}
