<?php
/**
 * Copyright 2016 Xenofon Spafaridis
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Phramework\Util;


/**
 * @coversDefaultClass Phramework\Util\Util
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache-2.0
 * @author Xenofon Spafaridis <nohponex@gmail.com>
 */
class UtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::isJSON
     */
    public function testIsJSON()
    {
        $this->assertFalse(
            Util::isJSON('')
        );

        $this->assertTrue(
            Util::isJSON('""')
        );

        $this->assertTrue(
            Util::isJSON('{"object" : "OK"}')
        );

        $this->assertTrue(
            Util::isJSON('["ok", "y" ]')
        );

        $this->assertTrue(
            Util::isJSON('"ok"')
        );

        $this->assertTrue(
            Util::isJSON('5')
        );

        $this->assertFalse(
            Util::isJSON('{"object" : "OK"}warning')
        );
    }

    /**
     * @covers ::readableRandomString
     */
    public function testReadableRandomString()
    {
        $this->assertSame(
            5,
            strlen(Util::readableRandomString(5)),
            'Expect same length as given length parameter'
        );

        $this->assertSame(
            6,
            strlen(Util::readableRandomString(6)),
            'Expect same length as given length parameter'
        );
    }

    /**
     * @covers ::isArrayOf
     * @todo
     */
    public function testIsArrayOf()
    {
        $strings = ['1', '10', '612ea09b-934d-4d0a-ac33-f26509feb91c'];

        $this->assertTrue(Util::isArrayOf($strings, 'string'));
        $this->assertTrue(Util::isArrayOf([], 'string'));
        $this->assertFalse(Util::isArrayOf($strings, Resource::class));
    }

    /**
     * @covers ::isArrayAssoc
     */
    public function testIsArrayAssoc()
    {
        $array = [1, 2, 3];

        $arrayAssoc1 = [
            '1' => 1,
            'b' => 2
        ];

        $arrayAssoc2 = [
            0 => 1,
            1 => 2
        ];

        $this->assertFalse(Util::isArrayAssoc($array));

        $this->assertTrue(Util::isArrayAssoc($arrayAssoc1));

        $this->assertFalse(Util::isArrayAssoc($arrayAssoc2));

        $this->assertTrue(Util::isArrayAssoc([]));
    }

    /**
     * @covers ::cartesian
     */
    public function testCartesian()
    {
        $input = [
            'arm' => ['A', 'B', 'C']
        ];

        $return = Util::cartesian($input);

        $this->assertInternalType('array', $return);

        $this->assertCount(3, $return);

        $input = [
            'arm' => ['A', 'B', 'C'],
            'gender' => ['Female', 'Male'],
            'location' => ['Vancouver', 'Calgary'],
        ];

        $return = Util::cartesian($input);

        $this->assertInternalType('array', $return);
        $this->assertCount(3*2*2, $return);

        $this->assertInternalType('array', $return[0]);

        $this->assertCount(count($input), $return[0]);
    }

    /**
     * @covers ::startsWith
     */
    public function testStartsWith()
    {
        $string = 'abcdef';

        $this->assertTrue( Util::startsWith($string, 'ab'));
        $this->assertTrue( Util::startsWith($string, ''));
        $this->assertFalse(Util::startsWith($string, 'cd'));
        $this->assertFalse(Util::startsWith($string, 'ef'));
        $this->assertFalse(Util::startsWith('',      $string));
    }

    /**
     * @covers ::startsWith
     */
    public function testEndsWith()
    {
        $string = 'abcdef';

        $this->assertFalse(Util::endsWith($string, 'ab'));
        $this->assertTrue( Util::endsWith($string, ''));
        $this->assertFalse(Util::endsWith($string, 'cd'));
        $this->assertTrue( Util::endsWith($string, 'ef'));
        $this->assertFalse(Util::endsWith('',      $string));
    }
}
