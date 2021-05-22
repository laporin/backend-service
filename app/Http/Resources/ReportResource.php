<?php

namespace App\Http\Resources;

use App\Http\Resources\MediaCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'serial' => $this->serial,
            'user' => new ReportUserResource($this->user),
            'category' => new ReportCategoryResource($this->category),
            'detail' => $this->detail,
            'address' => $this->address,
            'city' => $this->city,
            'subdistrict' => $this->subdistrict,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'private' => filter_var($this->private, FILTER_VALIDATE_BOOLEAN),
            'image' => new MediaCollection($this->media->all()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
