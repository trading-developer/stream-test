<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Resources\StreamResource;
use App\Models\User;
use App\Services\Antmedia\Broadcasts;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function indexAction(IndexRequest $request)
    {
        $data = $request->validated();

        $broadcasts = new Broadcasts();

        //cache::remember !!!!
        $list = Cache::remember('home-page-br-list', 1, function () use ($data, &$request, &$broadcasts) {
            $result = StreamResource::collection(
                $broadcasts->getList(
                    $data['offset'] ?? 0,
                    $data['size'] ?? Broadcasts::DEFAULT_PER_PAGE
                )
            );

            //to json - если будет нужен ответ в json(когда понадобится клиент на angular/vue)
            return $result->toArray($request);


            try {
            } catch (\Throwable $e) {
                return $this->returnError('error');
            }
        });

        return view('index.index', [
            'broadcasts' => $list,
            'countActiveLiveStream' => $broadcasts->getCountActiveLiveStream(),
        ]);
    }

}

