<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::anyOf', function (): void {
    it('should matches when any of the parsers match', function (string $input, string $expected, int $length): void {
        // Arrange
        $anyOf = Pacman::anyOf(
            Pacman::string('foo'),
            Pacman::alpha(),
            Pacman::digit(),
        );

        // Act
        $actual = $anyOf->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe($length);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'a', 1],
        ['123', '1', 1],
        ['foo', 'foo', 3],
        ['bar', 'b', 1],
    ]);

    it('should not matches when none of the parsers match', function (string $input): void {
        // Arrange
        $anyOf = Pacman::anyOf(
            Pacman::string('foo'),
            Pacman::alpha(),
            Pacman::digit(),
        );

        // Act
        $actual = $anyOf->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['!abc'],
        [' foo'],
    ]);
});
