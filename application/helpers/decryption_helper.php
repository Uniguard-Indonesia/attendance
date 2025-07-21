<?php
if (!function_exists('decryption')) {
    function decryption($encryption, $decryption_iv, $decryption_key)
    {
        $ciphering = "AES-128-CTR";
        // Store the decryption key
        $options = 0;
        // Use openssl_decrypt() function to decrypt the data
        $decryption = openssl_decrypt(
            $encryption,
            $ciphering,
            $decryption_key,
            $options,
            $decryption_iv
        );

        return $decryption;
    }
}
