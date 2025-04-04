<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::alphaNum', function (): void {
    it('should matches any alphanumeric character', function (string $input, string $expected): void {
        // Arrange
        $alphaNum = Pacman::alphaNum();

        // Act
        $actual = $alphaNum->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'a'],
        ['123', '1'],
        ['abc123', 'a'],
    ]);

    it('should not matches any non-alphanumeric character', function (string $input): void {
        // Arrange
        $alphaNum = Pacman::alphaNum();

        // Act
        $actual = $alphaNum->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['!abc'],
        [' '],
    ]);
});
