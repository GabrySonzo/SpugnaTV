<?php

require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

try {
    $decoded = JWT::decode($token, new Key("userKey", 'HS256'));
    return $response->withJson(['data' => (array) $decoded]);
} catch (\Exception $e) {
    return $response->withStatus(401)->withJson(['error' => $e->getMessage()]);
}

?>