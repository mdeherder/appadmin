<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    public function __construct(
        private MarkdownParserInterface $markdownParser,
        private CacheInterface $cache,
        private bool $isDebug,
        private LoggerInterface $logger
    ) {
    }

    public function parse(string $source): string
    {
        if (false !== stripos($source, 'cat')) {
            $this->logger->info('Meow!');
        }

        if ($this->isDebug) {
            return $this->markdownParser->transformMarkdown($source);
        }

        return $this->cache->get('markdown_'.md5($source), function () use ($source) {
            return $this->markdownParser->transformMarkdown($source);
        });
    }
}
