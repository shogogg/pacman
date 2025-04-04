<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::regexp', function (): void {
    it('should matches when the input matches the regex', function (string $input, string $expected): void {
        // Arrange
        $regexp = Pacman::regexp('/\A(?:foo|bar|baz)/i');

        // Act
        $actual = $regexp->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(strlen($expected));
        expect($actual->value())->toBe($expected);
    })->with([
        ['foo.bar.baz', 'foo'],
        ['BAR-BAZ', 'BAR'],
        ['baz, qux', 'baz'],
    ]);

    it('should not matches when the input does not match the regex', function (string $input): void {
        // Arrange
        $regexp = Pacman::regexp('/\A(?:foo|bar|baz)/i');

        // Act
        $actual = $regexp->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc'],
        ['123'],
    ]);
});
