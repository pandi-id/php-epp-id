<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', true);

chdir(__DIR__);

require '../vendor/autoload.php';

use Pandi\EPP\Frame\Command\Check\Domain as CheckDomain;

$frame = new CheckDomain();
$frame->addDomain('pandi.id');
$frame->addDomain('pandi.my.id');
$frame->addDomain('pandi.web.id');
echo $frame;
