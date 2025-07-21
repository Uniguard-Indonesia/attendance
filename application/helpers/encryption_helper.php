<?php
if (!function_exists('encryption')) {
    function encryption($decryption, $encryption_iv, $encryption_key)
    {
        $simple_string = $decryption;
        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption = openssl_encrypt(
            $simple_string,
            $ciphering,
            $encryption_key,
            $options,
            $encryption_iv
        );
        return $encryption;
    }
}
