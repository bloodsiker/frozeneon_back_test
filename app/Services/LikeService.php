<?php

namespace App\Services;

use App\Models\Analytics;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeService {

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
     * @param  object  $object
     *
     * @return array|array[]|string[]|void
     */
    public function addLike(object $object)
    {
        $user = Auth::user();

        if ($user->likes_balance < 1) {
            return ['error' => true, 'message' => 'Not enough likes in the account'];
        }

        try {
            if (method_exists($object, 'addLike')) {

                DB::beginTransaction();
                $object->addLike();
                $user->writeOff(1);

                if ($object instanceof Post) {
                    $objectType = Analytics::TRANSACTION_TYPE_POST;
                }
                if ($object instanceof Comment) {
                    $objectType = Analytics::TRANSACTION_TYPE_COMMENT;
                }

                if (isset($objectType)) {
                    $this->analyticsService->create(
                        1,
                        $objectType,
                        Analytics::ACTION_TYPE_LIKE,
                        $object->id
                    );
                }

                DB::commit();

                return [
                    'likes' => $object->likes,
                ];
            }
        } catch (\Throwable $e) {
            DB::rollback();

            return ['error' => 'Server error'];
        }
    }
}
