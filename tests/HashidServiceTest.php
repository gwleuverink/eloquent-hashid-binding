<?php

namespace Leuverink\HashidBinding\Tests;

use Leuverink\HashidBinding\HashidService;

class HashidServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(HashidService::class);
    }

    /** @test */
    public function it_encodes_a_given_value()
    {
        $encodedValue = $this->service->encode(1, TestModel::class);

        $this->assertNotNull($encodedValue);
    }

    /** @test */
    public function it_decodes_a_given_value()
    {
        $initialValue = 1;
        $encodedValue = $this->service->encode($initialValue, TestModel::class);
        $decodedValue = $this->service->decode($encodedValue, TestModel::class);

        $this->assertSame($initialValue, $decodedValue);
    }

    /** @test */
    public function it_returns_a_encoded_string_with_configured_length()
    {
        $expectedLength = $this->app->config->get('hashid-binding.min_length');
        $encodedValue = $this->service->encode(1, TestModel::class);

        $this->assertEquals($expectedLength, strlen($encodedValue));
    }
}
