<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RsaKey extends JsonResource
{
   /**
    * API Resource设施可以让我们在返回数据库内容之前，对数据进行一些定制。这个定制既可以是
    * 针对单一数据库记录的，也可以是针对一个数据库结果集的 
    */
    public function toArray($request)
    {
        /**
         * 可以直接用$this访问rsa_keys表中的字段，Laravel会把这个访问直接代理到对应的model.
        */
        return [
            'public' => $this->public,
            'version' => $this->version
        ];
    }
}
