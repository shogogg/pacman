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
final readonly class AnyOfParser extends AbstractParser
{
    /**
     * {@see AnyOfParser} constructor.
     *
     * @param Parser<T>[] $parsers
     */
    private function __construct(private array $parsers)
    {
    }

    /**
     * Creates a new instance of {@see AnyOfParser}.
     *
     * @template U
     * @param Parser<U>[] $parsers
     * @return Parser<U>
     */
    public static function of(array $parsers): Parser
    {
        return new self($parsers);
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
