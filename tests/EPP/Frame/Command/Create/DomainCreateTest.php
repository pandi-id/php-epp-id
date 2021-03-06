<?php

namespace Pandi\Tests\EPP\Frame\Command\Create;

use Pandi\EPP\Frame\Command\Create\Domain;
use PHPUnit\Framework\TestCase;

class DomainCreateTest extends TestCase
{
    public function testDomainCreateFrame()
    {
        $frame = new Domain();
        $frame->setDomain(TEST_DOMAIN);
        $frame->setPeriod('1y');
        $frame->addHostAttr('ns2.' . TEST_DOMAIN);
        $frame->addHostAttr('ns1.' . TEST_DOMAIN, [
            '8.8.8.8',
            '2a00:1450:4009:809::100e',
        ]);
        $frame->setRegistrant('C001');
        $frame->setAdminContact('C002');
        $frame->setTechContact('C003');
        $auth = $frame->setAuthInfo();

        $this->assertXmlStringEqualsXmlString(
            '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
              <command>
                <create>
                  <domain:create xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
                    <domain:name>' . TEST_DOMAIN . '</domain:name>
                    <domain:period unit="y">1</domain:period>
                    <domain:ns>
                      <domain:hostAttr>
                        <domain:hostName>ns2.' . TEST_DOMAIN . '</domain:hostName>
                      </domain:hostAttr>
                      <domain:hostAttr>
                        <domain:hostName>ns1.' . TEST_DOMAIN . '</domain:hostName>
                        <domain:hostAddr ip="v4">8.8.8.8</domain:hostAddr>
                        <domain:hostAddr ip="v6">2a00:1450:4009:809::100e</domain:hostAddr>
                      </domain:hostAttr>
                    </domain:ns>
                    <domain:registrant>C001</domain:registrant>
                    <domain:contact type="admin">C002</domain:contact>
                    <domain:contact type="tech">C003</domain:contact>
                    <domain:authInfo>
                      <domain:pw>' . $auth . '</domain:pw>
                    </domain:authInfo>
                  </domain:create>
                </create>
              </command>
            </epp>
            ',
            (string) $frame
        );
    }
}
