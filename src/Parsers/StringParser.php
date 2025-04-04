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
 * Parser that matches a specified string.
 *
 * @implements Parser<string>
 */
final readonly class StringParser extends AbstractParser
{
    private int $length;

    /**
     * {@see StringParser} constructor.
     *
     * @param string $expected
     */
    private function __construct(private string $expected)
    {
        $this->length = strlen($expected);
    }

    /**
     * Creates a new instance of {@see StringParser}.
     *
     * @param string $expected
     * @return Parser<string>
     */
    public static function of(string $expected): Parser
    {
        return new self($expected);
    }

    /** {@inheritdoc} */
    public function parseFrom(string $input, int $offset = 0): ParserOutput
    {
        return mb_substr($input, $offset, $this->length) === $this->expected
            ? Success::of($this->expected, $this->length)
            : Failure::getInstance();
    }
}
