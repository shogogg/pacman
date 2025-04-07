<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::anyCharOf', function (): void {
    it('should match any character from the specified options', function (
        string $options,
        string $additionalOptions,
        string $input,
        string $expected,
    ): void {
        // Arrange
        $anyCharOf = Pacman::anyCharOf($options, $additionalOptions);

        // Act
        $actual = $anyCharOf->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'ABC', 'abc', 'a'],
        ['abc', 'ABC', 'ABC', 'A'],
        ['abc', 'ABC', 'can', 'c'],
        ['abc', 'ABC', 'Bob', 'B'],
        ['アイウエオ', 'カキクケコ', 'エイリアン', 'エ'],
        ['アイウエオ', 'カキクケコ', 'キリギリス', 'キ'],
    ]);

    it('should not match a character not in the specified options', function (
        string $options,
        string $additionalOptions,
        string $input,
    ): void {
        // Arrange
        $anyCharOf = Pacman::anyCharOf($options, $additionalOptions);

        // Act
        $actual = $anyCharOf->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc', 'ABC', 'def'],
        ['abc', 'ABC', 'xyz'],
        ['abc', 'ABC', '123'],
        ['abc', 'ABC', '!@#'],
        ['あいうえお', 'かきくけこ', 'エイリアン'],
        ['あいうえお', 'かきくけこ', 'キリギリス'],
    ]);
});
