<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', true);

chdir(__DIR__);

require '../vendor/autoload.php';

use Pandi\EPP\Extension\Rgp\Update\Domain as RestoreDomain;

$frame = new RestoreDomain();
$frame->setDomain('panditest.id');
$frame->restoreRequest();
echo $frame;
