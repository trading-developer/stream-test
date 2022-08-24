<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class StreamResource extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['streamId'] ?? '',
            'name' => $this['name'] ?? '',
            'description' => $this['description'] ?? '',
            'rtmp_url' => $this['rtmpURL'] ?? '',
            'type' => $this['type'] ?? '',
            'created_at' => !empty($this['date']) ? Carbon::createFromTimestampMs((int)$this['date'])->toDateTimeString() : '-',
        ];
    }
}
