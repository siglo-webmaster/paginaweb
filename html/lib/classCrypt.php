<?php
class classCrypt {
    function encrypt($str, $key)
    {
        # Add PKCS7 padding.
        $block = mcrypt_get_block_size('des', 'ecb');
        if (($pad = $block - (strlen($str) % $block)) < $block) {
        $str .= str_repeat(chr($pad), $pad);
        }

        return mcrypt_encrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
    }

    function decrypt($str, $key)
    {
        $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);

        # Strip padding out.
        $block = mcrypt_get_block_size('des', 'ecb');
        $pad = ord($str[($len = strlen($str)) - 1]);
        if ($pad && $pad < $block && preg_match(
            '/' . chr($pad) . '{' . $pad . '}$/', $str
                                                )
        ) {
        return substr($str, 0, strlen($str) - $pad);
        }
        return $str;
    }

}

?>
