<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResponseCollection extends ResourceCollection
{
    public $status, $message, $data = [];

    public function __construct($status,$message,$data)
    {
       $this->status = $status;
       $this->message = $message;
       $this->data = $data;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'status' => $this->status,
            'message' => __($this->message),
            'data' => $this->data
        ];
    }
}
