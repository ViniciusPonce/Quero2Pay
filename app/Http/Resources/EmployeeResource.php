<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'nome_funcionario' => $this->nome_funcionario,
            'cargo' => $this->cargo,
            'salario' => $this->salario,
            'empresa_id' => $this->empresa_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
