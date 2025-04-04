<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman\Parsers;

use Pacman\Contracts\Parser;
use Pacman\Contracts\ParserOutput;

/**
 * Parser that uses a closure to parse input.
 *
 * @extends AbstractParser<string>
 */
final readonly class ClosureParser extends AbstractParser
{
    /**
     * {@see ClosureParser} constructor.
     *
     * @param \Closure(string, int): ParserOutput<string> $closure
     */
    private function __construct(private \Closure $closure)
    {
    }

    /**
     * Creates a parser that uses the given closure to parse input.
     *
     * @param \Closure(string, int): ParserOutput<string> $closure
     * @return Parser<string>
     */
    public static function of(\Closure $closure): Parser
    {
        return new self($closure);
    }

    /** {@inheritdoc} */
    protected function parseFrom(string $input, int $offset): ParserOutput
    {
        return ($this->closure)($input, $offset);
    }
}
