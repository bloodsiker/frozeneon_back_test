<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoosterpackRequest;
use App\Http\Resources\BoosterpackCollection;
use App\Http\Resources\BoosterpackInfoCollection;
use App\Repositories\BoosterpackRepository;
use App\Services\BoosterpackService;

class BoosterpackController extends Controller
{
    /**
     * @var BoosterpackRepository
     */
    private $repository;

    /**
     * @var BoosterpackService
     */
    private $service;

    /**
     * @param  BoosterpackRepository  $boosterpackRepository
     * @param  BoosterpackService     $boosterpackService
     */
    public function __construct(BoosterpackRepository $boosterpackRepository, BoosterpackService $boosterpackService)
    {
        $this->repository = $boosterpackRepository;
        $this->service    = $boosterpackService;
    }

    /**
     * @return BoosterpackCollection
     */
    public function all()
    {
        $boosterpacks = $this->repository->getAll();

        return new BoosterpackCollection($boosterpacks);
    }

    /**
     * @param  BoosterpackRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function buy(BoosterpackRequest $request)
    {
        // TODO: task 5, покупка и открытие бустерпака

        $boosterpack = $this->repository->getOneById($request->get('id'));
        $result = $this->service->getRandomItem($boosterpack);

        return response()->json($result);
    }

    /**
     * @param  int  $id
     *
     * @return BoosterpackInfoCollection
     */
    public function getInfo(int $id)
    {
        // TODO получить содержимое бустерпака

        $boosterpack = $this->repository->getOneById($id);

        return new BoosterpackInfoCollection($boosterpack->items);
    }
}
