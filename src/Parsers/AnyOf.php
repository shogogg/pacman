<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman\Parsers;

use Pacman\Contracts\Parser;
use Pacman\Contracts\ParserOutput;
use Pacman\Failure;

/**
 * Parser that matches any of the specified parsers.
 *
 * @template T
 * @extends AbstractParser<T>
 */
final readonly class AnyOf extends AbstractParser
{
    /**
     * {@see AnyOf} constructor.
     *
     * @param Parser<T> ...$parsers
     */
    public function __construct(private array $parsers)
    {
    }

    /** {@inheritdoc} */
    protected function parseFrom(string $input, int $offset): ParserOutput
    {
        /** @var Parser<T> $parser */
        foreach ($this->parsers as $parser) {
            $output = $parser->parse($input, $offset);
            if ($output->isSuccessful()) {
                return $output;
            }
        }
        return Failure::getInstance();
    }
}
