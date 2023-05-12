<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Psy\CodeCleaner\AssignThisVariablePass;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'image' => $this->logo ?  url("storage/{$this->logo}") : '',
            'uuid' => $this->uuid,
            'flag' => $this->url,
            'contact' => $this->email,
            'date_created' => Carbon::parse($this->created_at)->format('d-M-Y H:i:s'),
        ];
    }
}
