<?php

namespace App\Services\Antmedia;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Broadcasts
{
    public const DEFAULT_PER_PAGE = 9;

    public const PER_PAGES_TYPES = [
        self::DEFAULT_PER_PAGE, 18, 27
    ];

    /**
     * @throws \Exception
     */
    public function getList(int $offset = 0, int $size = self::DEFAULT_PER_PAGE)
    {
        $api = new RestApiClient();

        try {
            $result = $api->getBodyJsonDecode(
                sprintf('v2/broadcasts/list/%d/%d?sort_by=date&order_by=desc', $offset, $size));
        } catch (\Throwable $e) {
            Log::error('Service[Broadcasts-list] response exception: ' . $e->getMessage());
            throw new \Exception('Возникла непредвиденная ошибка' . $e->getCode());
        }

        return $result;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getCountActiveLiveStream() : int
    {
        $api = new RestApiClient();

        try {
            $result = $api->getBodyJsonDecode('v2/broadcasts/active-live-stream-count');
        } catch (\Throwable $e) {
            Log::error('Service[Broadcasts-active-live-stream-count] response exception: ' . $e->getMessage());
            throw new \Exception('Возникла непредвиденная ошибка' . $e->getCode());
        }

        return $result['number'] ?? 0;
    }

    /**
     * @throws \Exception
     */
    public function getById($id)
    {
        $api = new RestApiClient();

        try {
            $result = $api->getBodyJsonDecode(sprintf('v2/broadcasts/%s', $id));
        } catch (\Throwable $e) {
            Log::error('Service[Broadcasts-id] response exception: ' . $e->getMessage());
            throw new \Exception('Возникла непредвиденная ошибка' . $e->getCode());
        }

        return $result;
    }

    /**
     * @throws \Exception
     */
    public function create(array $data)
    {
        $api = new RestApiClient();

        $data['username'] = Auth::user()->name;

        try {
            $result = $api->getBodyJsonDecode('v2/broadcasts/create', [
                'body' => json_encode($data)
            ], 'POST');
        } catch (\Throwable $e) {
            Log::error('Service[Broadcasts-create] response exception: ' . $e->getMessage());
            throw new \Exception('Возникла непредвиденная ошибка' . $e->getCode());
        }

        return $result;
    }
}
