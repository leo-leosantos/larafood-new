<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'identify' => $this->identify,
            'total'=>$this->total,
            'status'=>$this->status,
            'client'=>$this->client_id  ? new ClientResource($this->client) : '',
            'table'=>$this->table_id ? new TableResource($this->table) : '',
            'products'=> ProductResource::collection($this->products) ,
            'date'=> Carbon::make($this->created_at)->format('Y-m-d H:i:s'),
            'Company'=> New TenantResource($this->tenant),
            'evaluations'=> EvaluationResource::collection($this->evaluations) ,
        ];
    }
}
