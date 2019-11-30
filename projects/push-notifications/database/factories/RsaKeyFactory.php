<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RsaKey;
use Faker\Generator as Faker;

$keyVersion = 0;
$factory->define(RsaKey::class, function (Faker $faker) use(&$keyVersion){
    $public = "-----BEGIN PUBLIC KEY-----
    MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC0vJg6Do7XpOklNAgZAV6YCao1
    in7gBud3In6jYC6Lw9pjE4dgDGc8bouVF63XVtoMHIVQbQi7x2k+dILJIwW+PLF+
    ohEFYij3ZuOUMRIDi9S3vjy8B7BJs3WklX6fEu/h+79CwqViEEM6QIMT2nLesALz
    xFHvnIi3GKSmmKrPeQIDAQAB
    -----END PUBLIC KEY-----
    ";
    $private = "-----BEGIN RSA PRIVATE KEY-----
    MIICWwIBAAKBgQC0vJg6Do7XpOklNAgZAV6YCao1in7gBud3In6jYC6Lw9pjE4dg
    DGc8bouVF63XVtoMHIVQbQi7x2k+dILJIwW+PLF+ohEFYij3ZuOUMRIDi9S3vjy8
    B7BJs3WklX6fEu/h+79CwqViEEM6QIMT2nLesALzxFHvnIi3GKSmmKrPeQIDAQAB
    AoGAPhaz7O3nYGmEtoUjawOvbWeUk4QahfeZOLIe8x0toFIOCg9BaFuac4Y+aV+T
    FvD9Qz/hBHoQkAG3Q/9elp5zcAyoIYcA1BXut01144MJz207NHMLMCJwm5iBab73
    A2ern3dOgJ09AoALI5zX2n2TTYBEXAfjKOtz1HFb6Jqc9qkCQQDq7mcGYrC8bQjU
    DCTMD2Jcz+oBQS6dEAV0QXuFPiIFHj1Y0Mk6K+l9+s2fXWUEZdMEB3lZ3E3Bmz4h
    8dBesz9/AkEAxPH7n5DSmnfOsCoWzmbSrguJ66bw5ELpp7wJlcfi+SKilEOBeQmQ
    QYhDbBj6Y7t1vhvbyrAF4z4Ruha3rcVtBwJAZNLXyDfGnbc1mLt1d1YK4sYgKVWu
    CZ38mT4ZIr/dndCyh1FjauG5nWVrpb9RQSfp/cqvW89eV36mla7PvDS1RQJAMGWq
    yP6E0pLIhwAA1L3t3flV7kP7BIzw8FhEHrudKk35l+ey5HSWL5R1xRWqSmHhwFMG
    QxvYhoxVPN6iSqCudwJASX7mH2m3cn8/jrgDn0X8JwPhkLVP+jM1jFZm5ideVVKf
    ov+1jQMaT2DSNOJxoHyhTpznefw7Nr5+y5pJXB+4jw==
    -----END RSA PRIVATE KEY-----";
    $passcode = 'boxue';
    $keyVersion += 1;
    return [
        'public' => $public,
        'private' => $private,
        'passcode' => $passcode,
        "version" => $keyVersion
    ];
});
