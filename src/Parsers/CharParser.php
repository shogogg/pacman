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
use Pacman\Success;

/**
 * Parser that matches a single character.
 *
 * @extends AbstractParser<string>
 */
final readonly class CharParser extends AbstractParser
{
    /**
     * {@see CharParser} constructor.
     *
     * @param \Closure(string): bool $predicate
     */
    private function __construct(private \Closure $predicate)
    {
    }

    /**
     * Creates a new instance of {@see CharParser}.
     *
     * @param \Closure(string): bool $predicate
     * @return Parser<string>
     */
    public static function of(\Closure $predicate): Parser
    {
        return new self($predicate);
    }

    /** {@inheritdoc} */
    protected function parseFrom(string $input, int $offset): ParserOutput
    {
        $char = mb_substr($input, $offset, 1);
        return ($this->predicate)($char) ? Success::of($char, 1) : Failure::getInstance();
    }
}
