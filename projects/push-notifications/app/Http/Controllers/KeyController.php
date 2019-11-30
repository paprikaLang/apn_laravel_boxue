<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\RsaKey as RsaKeyResource;

class KeyController extends Controller
{
    public function getPublicKeyVersion() {
        $key = DB::table('rsa_keys')
        ->orderBy('version', 'desc')
        ->select('version')
        ->first();

        if ($key === NULL) {
            return response()->json([
                'reason' => 'key does not exist'
            ], 404);
        }

        return response()->json([
            'version' => $key->version 
        ]);

    }
    public function getPublicKey() {
        $key = DB::table('rsa_keys')
        ->orderBy('version', 'desc')
        ->first();

        if ($key == NULL) {
            return response()->json([
                'reason' => 'Key does not exist!'
            ], 404);
        }

        // return new RsaKeyResource($key); //返回的结果有data字段
        return response()->json(new RsaKeyResource($key)); //json化后没有data字段了. 
    }
}
