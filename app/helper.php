<?php

use App\Http\Controllers\ActivityLogController;
use App\Models\ActivityLog;
use Illuminate\Support\Str;

function image($nombre)
{
    return asset('images/' . $nombre);
}

function jcrypt($plaintext)
{
    $key = env('ENCRYPT_PASS');
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
    return $ciphertext;
}

function jdecrypt($ciphertext)
{
    $key = env('ENCRYPT_PASS');
    $c = base64_decode($ciphertext);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
    if (hash_equals($hmac, $calcmac)) {
        return $original_plaintext;
    }
}

function toSqlQuery($query)
{
    return Str::replaceArray('?', $query->getBindings(), $query->toSql());
}

function saveLog($model, $event, $message, $request, $ip = '1.1.1.1', $user = 1, $model_id = null)
{
    ActivityLogController::save($model, $model_id, $event, $message, json_encode($request), $ip, $user);
    return $message;
}
