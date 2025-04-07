<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::anyChar', function (): void {
    it('should match any character', function (string $input, string $expected): void {
        // Arrange
        $anyChar = Pacman::anyChar();

        // Act
        $actual = $anyChar->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['a', 'a'],
        ['BC', 'B'],
        ['xyz', 'x'],
        ['あいうえお', 'あ'],
        ['123', '1'],
        ['!@#$', '!'],
        [' ', ' '],
    ]);

    it('should not match an empty string', function (): void {
        // Arrange
        $anyChar = Pacman::anyChar();

        // Act
        $actual = $anyChar->parse('');

        // Assert
        expect($actual)->toBeFailure();
    });
});
