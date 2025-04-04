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
 * Parser that matches a specified regular expression.
 *
 * @implements Parser<string>
 */
final readonly class RegExpParser extends AbstractParser
{
    /**
     * {@see StringParser} constructor.
     *
     * @param string $pattern
     */
    private function __construct(private string $pattern)
    {
    }

    /**
     * Creates a new instance of {@see RegExpParser}.
     *
     * @param string $pattern
     * @return Parser<string>
     */
    public static function of(string $pattern): Parser
    {
        return new self($pattern);
    }

    /** {@inheritdoc} */
    public function parseFrom(string $input, int $offset = 0): ParserOutput
    {
        return preg_match($this->pattern, mb_substr($input, $offset), $m) === 1
            ? Success::of($m[0], mb_strlen($m[0]))
            : Failure::getInstance();
    }
}
