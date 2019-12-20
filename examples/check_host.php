<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', true);

chdir(__DIR__);

require '../vendor/autoload.php';

use Pandi\EPP\Frame\Command\Check\Host as CheckHost;

$frame = new CheckHost();
$frame->addHost('ns1.pandi.id');
$frame->addHost('ns2.pandi.id');
$frame->addHost('ns3.pandi.id');
echo $frame;
