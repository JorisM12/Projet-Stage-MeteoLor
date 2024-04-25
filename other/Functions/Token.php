<?php
function token()
{
    $token = 0;
    for ($i=0; $i < 5; $i++) 
    {
        $token = $token.rand(0,5);
        return $token;
    }
}