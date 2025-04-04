<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Success;

describe('::of', function (): void {
    it('should returns a new instance of Success', function (): void {
        $success = Success::of('value', 5);
        expect($success)->toBeInstanceOf(Success::class);
    });
});

describe('->isSuccessful', function (): void {
    it('should returns true', function (): void {
        $success = Success::of('value', 5);
        expect($success->isSuccessful())->toBeTrue();
    });
});

describe('->length', function (): void {
    it('should returns the length of the value', function (string $input, int $length): void {
        $success = Success::of($input, $length);
        expect($success->length())->toBe($length);
    })->with([
        ['book', 4],
        ['computer', 8],
        ['eraser', 6],
        ['highlight', 9],
    ]);
});

describe('->value', function (): void {
    it('should returns the value', function (string $input, int $length): void {
        $success = Success::of($input, $length);
        expect($success->value())->toBe($input);
    })->with([
        ['book', 4],
        ['computer', 8],
        ['eraser', 6],
        ['highlight', 9],
    ]);
});
