<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman;

use Pacman\Contracts\Parser;
use Pacman\Contracts\ParserOutput;
use Pacman\Parsers\ClosureParser;

final class Pacman
{
    /**
     * Creates a parser that matches alphabetic characters.
     *
     * @return Parser<string>
     */
    public static function alpha(): Parser
    {
        return ClosureParser::of(function (string $input, int $offset): ParserOutput {
            $char = substr($input, $offset, 1);
            return ctype_alpha($char) ? Success::of($char, 1) : Failure::getInstance();
        });
    }

    /**
     * Creates a parser that matches numeric characters.
     *
     * @return Parser<string>
     */
    public static function digit(): Parser
    {
        return ClosureParser::of(function (string $input, int $offset): ParserOutput {
            $char = substr($input, $offset, 1);
            return ctype_digit($char) ? Success::of($char, 1) : Failure::getInstance();
        });
    }
}
