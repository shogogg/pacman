<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::fake', function (): void {
    it('should always succeed when success is true', function (string $input, int $length): void {
        // Arrange
        $fake = Pacman::fake(success: true);

        // Act
        $actual = $fake->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe($length);
        expect($actual->value())->toBe($input);
    })->with([
        ['abc', 3],
        ['123', 3],
        ['!xyz', 4],
    ]);

    it('should always fail when success is false', function (string $input): void {
        // Arrange
        $fake = Pacman::fake(success: false);

        // Act
        $actual = $fake->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc'],
        ['123'],
        ['!xyz'],
    ]);
});
