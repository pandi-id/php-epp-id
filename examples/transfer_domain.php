<?php

// debug
error_reporting(E_ALL);
ini_set('display_errors', true);

chdir(__DIR__);

require '../vendor/autoload.php';

use Pandi\EPP\Frame\Command\Transfer\Domain as TransferDomain;

$frame = new TransferDomain();
$frame->setOperation('cancel');
$frame->setDomain('google.com');
$frame->setPeriod('6y');
$frame->setAuthInfo('password', 'REP-REP-YEP');
echo $frame;
