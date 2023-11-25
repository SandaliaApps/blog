<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthCollection extends ResourceCollection
{
    public $user,$message,$status;

    public function __construct($user,$message,$status)
    {
        $this->user = $user;
        $this->message = $message;
        $this->status = $status;
    }

    public function toArray(Request $request): array
    {
        return [
            'status' =>$this->status,
            'message'=> $this->message,
            'data' => $this->user,
            'authorization' => [
                'token' => $this->user->createToken('ApiToken')->plainTextToken,
                'type' => 'bearer',
            ]
        ];
    }
}
