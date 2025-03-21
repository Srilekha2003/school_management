<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($payload, $secretKey)
{
    return JWT::encode($payload, $secretKey, 'HS256');
}

function validateJWT($token, $secretKey)
{
    try {
        return JWT::decode($token, new Key($secretKey, 'HS256'));
    } catch (Exception $e) {
        return false;
    }
}
