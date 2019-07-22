<?php

namespace Pandi\Tests\EPP;

use Pandi\EPP\Translit;
use PHPUnit\Framework\TestCase;

class TranslitTest extends TestCase
{
    public function testUmlaut()
    {
        $umlaut = 'Günter';
        $ascii = 'Gunter';

        $this->assertEquals($ascii, Translit::transliterate($umlaut));
    }
}
