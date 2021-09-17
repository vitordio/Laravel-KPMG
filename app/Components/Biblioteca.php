<?php
namespace App\Components;

use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Biblioteca
{
    const METHOD_DELETE = '\DELETE';
    const METHOD_UPDATE = 'PATCH';
    const METHOD_PUT = 'PUT';
    const METHOD_POST = 'POST';
    const METHOD_SHOW = 'SHOW';

    const FLG_ATIVO = 'S';
    const FLG_DESATIVO = 'N';

    public static function desencriptar($id)
    {
        try
        {
            $id = Crypt::decryptString($id);
        }
        catch (DecryptException $e)
        {
            $id = '';
        }

        return $id;
    }

    /**
     * Remove as máscaras
    */
    public static function removeMasks($inputValue)
    {
        $valueWithoutMask = trim($inputValue);
        $valueWithoutMask = str_replace(['.', ',', '-', '/', '(', ')', ' '], ['', '', '', '', '', '', ''], $valueWithoutMask);

        return $valueWithoutMask;
    }
}
