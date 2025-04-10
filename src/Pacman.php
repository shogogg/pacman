<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman;

use Pacman\Contracts\Parser;
use Pacman\Contracts\ParserOutput;
use Pacman\Parsers\AnyOfParser;
use Pacman\Parsers\CharParser;
use Pacman\Parsers\ClosureParser;
use Pacman\Parsers\RegExpParser;
use Pacman\Parsers\StringParser;

final class Pacman
{
    public const LOWER_ALPHABETS = 'abcdefghijklmnopqrstuvwxyz';
    public const UPPER_ALPHABETS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const ALPHABETS = self::LOWER_ALPHABETS . self::UPPER_ALPHABETS;
    public const DIGITS = '0123456789';
    public const WHITESPACES = " \t\n\r\0\x0B";

    /**
     *
     * Creates a parser that matches alphabetic characters.
     *
     * @return Parser<string>
     */
    public static function alpha(): Parser
    {
        return CharParser::of(ctype_alpha(...));
    }

    /**
     * Creates a parser that matches alphabetic or numeric characters.
     *
     * @return Parser<string>
     */
    public static function alphaNum(): Parser
    {
        return CharParser::of(ctype_alnum(...));
    }

    /**
     * Creates a parser that matches any character.
     *
     * @return Parser<string>
     */
    public static function anyChar(): Parser
    {
        return CharParser::of(fn (string $input): bool => mb_strlen($input) > 0);
    }

    /**
     * Creates a parser that matches any character from the specified options.
     *
     * @param string $options
     * @param string ...$additionalOptions
     * @return Parser<string>
     */
    public static function anyCharOf(string $options, string ...$additionalOptions): Parser
    {
        $chars = $options . implode('', $additionalOptions);
        return CharParser::of(fn (string $input): bool => str_contains($chars, $input));
    }

    /**
     * Creates a parser that matches any of the specified parsers.
     *
     * @template T
     * @param Parser<T> $head
     * @param Parser<T> ...$tail
     * @return Parser<T>
     */
    public static function anyOf(Parser $head, Parser ...$tail): Parser
    {
        return AnyOfParser::of([$head, ...$tail]);
    }

    /**
     * Creates a parser that matches a specific character.
     *
     * @param string $char
     * @return Parser<string>
     */
    public static function char(string $char): Parser
    {
        return CharParser::of(fn (string $input): bool => $input === $char);
    }

    /**
     * Creates a parser that matches numeric characters.
     *
     * @return Parser<string>
     */
    public static function digit(): Parser
    {
        return CharParser::of(ctype_digit(...));
    }

    /**
     * Creates a fake parser that always succeeds or fails.
     *
     * @param bool $success
     * @return Parser<string>
     */
    public static function fake(bool $success): Parser
    {
        return ClosureParser::of(function (string $input, int $offset) use ($success): ParserOutput {
            return $success
                ? Success::of(mb_substr($input, $offset), mb_strlen($input) - $offset)
                : Failure::getInstance();
        });
    }

    /**
     * Creates a parser that matches lowercase alphabetic characters.
     *
     * @return Parser<string>
     */
    public static function lower(): Parser
    {
        return CharParser::of(ctype_lower(...));
    }

    /**
     * Creates a parser that matches regular expression.
     *
     * @return Parser<string>
     */
    public static function regexp(string $pattern): Parser
    {
        return RegExpParser::of($pattern);
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
        return CharParser::of(ctype_upper(...));
    }

    /**
     * Creates a parser that matches whitespace characters.
     *
     * @return Parser<string>
     */
    public static function whitespace(): Parser
    {
        return CharParser::of(ctype_space(...));
    }
}
