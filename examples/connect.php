<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', true);

chdir(__DIR__);

require '../vendor/autoload.php';

use Pandi\EPP\Client as EPPClient;

$epp_client = new EPPClient([
    'host' => 'epp-dev.pandi.id',
    'username' => 'pandi',
    'password' => 'test',
    'services' => [
        'urn:ietf:params:xml:ns:domain-1.0',
        'urn:ietf:params:xml:ns:contact-1.0',
        'urn:ietf:params:xml:ns:host-1.0',
        'urn:ietf:params:xml:ns:epp-1.0'
    ],
    'debug' => true,
    'verify_peer' => false,
    'allow_self_signed' => true,
    'local_cert' => '',
    'pass_phrase' => '',
    'ssl' => false,
]);

try {
    $greeting = $epp_client->connect();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    unset($epp_client);
    exit(1);
}

$epp_client->close();
