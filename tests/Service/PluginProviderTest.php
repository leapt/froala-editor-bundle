<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Tests\Service;

use Leapt\FroalaEditorBundle\Service\PluginProvider;
use PHPUnit\Framework\TestCase;

final class PluginProviderTest extends TestCase
{
    private PluginProvider $provider;

    protected function setUp(): void
    {
        $this->provider = new PluginProvider();
    }

    public function testObtainArrPluginCamelized(): void
    {
        self::assertSame(['paragraphFormat'], $this->provider->obtainArrPluginCamelized(['paragraph_format']));
    }
}
