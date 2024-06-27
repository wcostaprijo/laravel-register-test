<?php 

if (!function_exists('removeCepMask')) {
    function removeCepMask($cep): int 
    {
        return intval(preg_replace('/\D/', '', $cep));
    }
}

if (!function_exists('applyCepMask')) {
    function applyCepMask($cep): string 
    {
        return strval(preg_replace('/^(\d{5})(\d{3})$/', '$1-$2', removeCepMask($cep)));
    }
}
