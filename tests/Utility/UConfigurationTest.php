<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Tests\Utility;

use Leapt\FroalaEditorBundle\Utility\UConfiguration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

final class UConfigurationTest extends TestCase
{
    public function testAllOptionsAreRegistered(): void
    {
        $url = 'https://froala.com/wysiwyg-editor/docs/options/';
        $httpClient = HttpClient::create();
        $crawler = new Crawler($httpClient->request('GET', $url)->getContent());
        $optionsFromDocs = $crawler->filter('.docs-data-list.block-box a');
        $registeredOptions = UConfiguration::getArrOptionAll();
        $proxyOrIgnoredOptions = ['Key', 'editor'];
        $missingOptions = [];

        foreach ($optionsFromDocs as $option) {
            if (!\in_array($option->textContent, $registeredOptions, true) && !\in_array($option->textContent, $proxyOrIgnoredOptions, true)) {
                $missingOptions[] = $option->textContent;
            }
        }

        self::assertSame([], $missingOptions);
    }
}
