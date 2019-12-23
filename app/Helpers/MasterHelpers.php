<?php
if  ( ! function_exists('general'))
{
    function general()
    {
        return new \App\Library\General();
    }
}

if  ( ! function_exists('aes_encrypt'))
{
    function aes_encrypt($str,$keyDefault=true)
    {
        return general()->encrypt($str,$keyDefault);
    }
}

if  ( ! function_exists('aes_decrypt'))
{
    function aes_decrypt($str,$keyDefault=true)
    {
        return general()->decrypt($str,$keyDefault);
    }
}

if ( ! function_exists('mod_access'))
{
    function mod_access($param,$role = 'read')
    {
        return general()->modAccess($param,$role);
    }
}
