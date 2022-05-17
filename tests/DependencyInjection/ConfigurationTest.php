<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ConfigurationTest extends KernelTestCase
{
    public function testLoad(): void
    {
        // Make sure default config loads without issues
        self::bootKernel();
        self::assertSame([], self::getContainer()->getParameter('leapt_froala_editor.profiles'));
    }
}
