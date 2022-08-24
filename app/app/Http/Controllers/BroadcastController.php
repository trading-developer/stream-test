<?php

namespace App\Http\Controllers;

use App\Http\Requests\Broadcast\CreateRequest;
use App\Http\Resources\StreamResource;
use App\Services\Antmedia\Broadcasts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BroadcastController extends Controller
{
    public function showAction(Request $request, $id)
    {
        $data = (Validator::make(
            [
                'id' => $id,
            ],
            [
                'id' => [
                    'required',
                    'numeric',
                    'max:24',
                    'min:20',
                ],
            ],
            [
                'id.required' => 'Broadcast id required',
                'id.numeric' => 'Broadcast id is not numeric',
            ]
        ))->getData();

        $broadcasts = new Broadcasts();

        try {
            $broadcast = new StreamResource($broadcasts->getById($data['id']));
        } catch (\Throwable $e) {
            return $this->returnError('error get br');
        }

        return view('broadcasts.show', [
            'broadcast' => $broadcast->toArray($request),
        ]);
    }

    public function showCreateAction()
    {
        return view('broadcasts.create');
    }

    public function createAction(CreateRequest $request) // Request $request
    {
        $data = $request->validated();
        unset($data['preview']);


        $broadcasts = new Broadcasts();

        //uploading file

        try {
            $broadcast = new StreamResource($broadcasts->create($data));
        } catch (\Throwable $e) {
            return redirect()->to('broadcasts.create')
                ->withErrors('aaaa');
        }

        return view('broadcasts.show', [
            'broadcast' => $broadcast->toArray($request),
        ]);
    }

}

