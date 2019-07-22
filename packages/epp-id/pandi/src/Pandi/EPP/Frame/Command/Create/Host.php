<?php

/**
 * This file is part of the php-epp2 library.
 *
 * (c) Gunter Grodotzki <gunter@afri.cc>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Pandi\EPP\Frame\Command\Create;

use Pandi\EPP\AddrTrait;
use Pandi\EPP\Frame\Command\Create as CreateCommand;
use Pandi\EPP\Validator;
use Exception;

/**
 * @see http://tools.ietf.org/html/rfc5732#section-3.2.1
 */
class Host extends CreateCommand
{
    use AddrTrait;

    public function setHost($hostname)
    {
        // validate hostname
        if (!Validator::isHostname($hostname)) {
            throw new Exception(sprintf('not a valid Hostname: %s', $hostname));
        }

        $this->set('host:name', $hostname);
    }

    public function addAddr($ip)
    {
        $this->appendAddr('host:addr[]', $ip);
    }
}
