<?php

namespace App\Services;

use App\Models\Analytics;
use App\Models\Boosterpack;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoosterpackService {

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
     * @param  Boosterpack  $boosterpack
     *
     * @return array
     */
    public function getRandomItem(Boosterpack $boosterpack): array
    {
        $user = Auth::user();

        try {
            DB::beginTransaction();

            if ($user->wallet_balance < $boosterpack->price) {
                return ['error' => true, 'message' => 'Not enough money in the account'];
            }

            $maxCost = $boosterpack->bank + ($boosterpack->price - $boosterpack->us);
            $items = [];
            foreach ($boosterpack->items as $item) {
                if ($item->price < $maxCost) {
                    $items[] = $item->id;
                }
            }

            $randomItem = $items[random_int(0, count($items) - 1)];

            $item = Item::find($randomItem);

            $user->wallet_balance -= $boosterpack->price;
            $user->likes_balance += $item->price;
            $user->wallet_total_withdrawn += $item->price;
            $user->save();

            $this->analyticsService->create(
                $boosterpack->price,
                Analytics::TRANSACTION_TYPE_BOOSTERPACK,
                Analytics::ACTION_TYPE_BUY,
                $boosterpack->id
            );

            $this->analyticsService->create(
                $item->price,
                Analytics::TRANSACTION_TYPE_LIKE,
                Analytics::ACTION_TYPE_ADD_LIKE,
                $boosterpack->id
            );

            $newProfitBank = $boosterpack->bank + $boosterpack->price - $boosterpack->us - $item->price;
            $boosterpack->bank = $newProfitBank;
            $boosterpack->save();

            DB::commit();

            return ['amount' => $item->price];

        } catch (\Throwable $e) {
            DB::rollback();

            return ['error' => 'Server error'];
        }
    }
}
