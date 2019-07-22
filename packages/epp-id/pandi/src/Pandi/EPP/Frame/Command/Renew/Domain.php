<?php

/**
 * This file is part of the php-epp2 library.
 *
 * (c) Gunter Grodotzki <gunter@afri.cc>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Pandi\EPP\Frame\Command\Renew;

use Pandi\EPP\Frame\Command\Renew as RenewCommand;
use Pandi\EPP\PeriodTrait;
use Pandi\EPP\Validator;
use Exception;

/**
 * @see http://tools.ietf.org/html/rfc5731#section-3.2.3
 */
class Domain extends RenewCommand
{
    use PeriodTrait;

    public function setDomain($domain)
    {
        if (!Validator::isHostname($domain)) {
            throw new Exception(sprintf('%s is not a valid domain name', $domain));
        }

        $this->set('domain:name', $domain);
    }

    public function setCurrentExpirationDate($curExpDate)
    {
        $this->set('domain:curExpDate', $curExpDate);
    }

    public function setPeriod($period)
    {
        $this->appendPeriod('domain:period[@unit=\'%s\']', $period);
    }
}
