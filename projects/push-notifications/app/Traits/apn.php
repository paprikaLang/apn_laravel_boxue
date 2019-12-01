<?php 

namespace App\Traits;
/**
 * 构建Apple要求的HTTP header显然是一个相对独立的功能，把这部分代码直接编写在PushNewNotification类里明显是不合适的。
 * 但是专门为这个功能生成一个类似乎也不是特别有必要, trait APN可以封装这部分实现, 并在 use APN时再调用这些实现.
*/
trait APN
{
    /**
     * alg表示加密token使用的算法，目前Apple只支持ES256，因此这是唯一的选择；
     * kid是之前从Apple获取到的证书文件名中的后10位字符；
     * iss是我们的Team ID；
     * iat则是生成这个header的时间；
    */
    // JWT header
    public function generateAPNKeyHeader()
    {
        return base64_encode(json_encode([
          'alg' => 'ES256',
          'kid' => env('AUTH_KEY_ID')
        ]));
    }
    // JWT claim
    public function generateAPNKeyClaims()
    {
        return base64_encode(json_encode([
            'iss' => env('TEAM_ID'),
            'iat' => time()
        ]));
    }
    
    public function getPrivateKey() {
      $keyPath = 'file://'.storage_path(env('AUTH_KEY_PATH'));
      return openssl_pkey_get_private($keyPath);
    }
    // 把JWT header和claim用字符.连接起来，并用Apple颁发给我们的证书加密
    public function generateAuthenticationHeader()
    {
        $header = $this->generateAPNKeyHeader();
        $claims = $this->generateAPNKeyClaims();
        $orig = $header.'.'.$claims;
        $key = $this->getPrivateKey();

        if ($key == FALSE) {
            throw new \Exception("Open private key failed");
        }
        // 调用openssl_sign之后，加密过的$orig会保存在$signature变量里
        openssl_sign($orig, $signature, $key, 'sha256');
        $signed = base64_encode($signature);
        // Apple要求的加密token
        return $orig.'.'.$signed;
    }
   
    public function generateAPNUri(int $environment)
    {
        switch ($environment) {
            case config('variables.sandbox'):
                $prefix = 'api.development';
                break;
            default:
                $prefix = 'api';
        }

        return "https://".$prefix.".push.apple.com/3/device/";
    }

    public function generateAPNHeader()
    {
        // apns-topic指定的是App的bundle ID
        // authorization: bearer + token 
        return [
            'apns-topic' => env('BUNDLE_ID'),
            'Accept' => 'application/json',
            'authorization' => 'bearer ' . $this->generateAuthenticationHeader()
        ];
    }

    public function generateAPNPayload($title, $body, $badge = -1, $sound = "")
    {
        $payload = [
            'aps' => [
                'alert' => [
                    'title' => $title,
                    'body' => $body
                ]
            ]
        ];

        if ($badge != -1) {
            $payload['aps'] += [ 'badge' => $badge ];
        }

        if ($sound != "") {
            $payload['aps'] += [ 'sound' => $sound ];
        }

        return json_encode($payload);
    }
}