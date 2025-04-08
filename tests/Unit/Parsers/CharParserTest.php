<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::char', function (): void {
    it('should match the specified character', function (
        string $input,
        string $expected,
    ): void {
        // Arrange
        $char = Pacman::char($expected);

        // Act
        $actual = $char->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'a'],
        ['ABC', 'A'],
        ['あいうえお', 'あ'],
        ['アイウエオ', 'ア'],
    ]);

    it('should not match a different character', function (
        string $input,
        string $expected,
    ): void {
        // Arrange
        $char = Pacman::char($expected);

        // Act
        $actual = $char->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc', 'b'],
        ['ABC', 'B'],
        ['あいうえお', 'い'],
        ['アイウエオ', 'イ'],
    ]);
});
