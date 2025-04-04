<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman;

use Pacman\Contracts\Parser;
use Pacman\Parsers\CharParser;
use Pacman\Parsers\StringParser;

final class Pacman
{
    /**
     * Creates a parser that matches alphabetic characters.
     *
     * @return Parser<string>
     */
    public static function alpha(): Parser
    {
        return CharParser::of(fn (string $char): bool => ctype_alpha($char));
    }

    /**
     * Creates a parser that matches alphabetic or numeric characters.
     *
     * @return Parser<string>
     */
    public static function alphaNum(): Parser
    {
        return CharParser::of(fn (string $char): bool => ctype_alnum($char));
    }

    /**
     * Creates a parser that matches numeric characters.
     *
     * @return Parser<string>
     */
    public static function digit(): Parser
    {
        return CharParser::of(fn (string $char): bool => ctype_digit($char));
    }

    /**
     * Creates a parser that matches lowercase alphabetic characters.
     *
     * @return Parser<string>
     */
    public static function lower(): Parser
    {
        return CharParser::of(fn (string $char): bool => ctype_lower($char));
    }

    /**
     * Creates a parser that matches specified string.
     *
     * @return Parser<string>
     */
    public static function string(string $expected): Parser
    {
        return StringParser::of($expected);
    }

    /**
     * Creates a parser that matches uppercase alphabetic characters.
     *
     * @return Parser<string>
     */
    public static function upper(): Parser
    {
        return CharParser::of(fn (string $char): bool => ctype_upper($char));
    }

    /**
     * Creates a parser that matches whitespace characters.
     *
     * @return Parser<string>
     */
    public static function whitespace(): Parser
    {
        return CharParser::of(fn (string $char): bool => ctype_space($char));
    }
}
