<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
//use Tests\TestCase;を使わないのは、ユニットテストはフレームワークの機能に依存しない形で書くことが望ましい、という考え方に基づいています。
//あくまで原則であって、フレームワークの機能（たとえば Facade など）を利用したユニットテストを書きたい場合は、継承元のクラスを Tests\TestCase に変更してください。

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
