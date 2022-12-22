<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CuadroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attributes = [];

       

        return [
            'type' => 'cuadros',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->when(!is_null($this->resource->name), $this->resource->name),
                'painter' => $this->when(!is_null($this->resource->painter), $this->resource->painter),
                'country' => $this->when(!is_null($this->resource->country), $this->resource->country),
            ],
            'links' => [
                'self' => route('api.v1.cuadros.show', $this->resource)
            ]
        ];
    }
}
