<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Failure;

describe('::getInstance', function (): void {
    it('should returns a new instance of Failure', function (): void {
        $failure = Failure::getInstance();
        expect($failure)->toBeInstanceOf(Failure::class);
    });
});

describe('->isSuccessful', function (): void {
    it('should returns false', function (): void {
        $failure = Failure::getInstance();
        expect($failure->isSuccessful())->toBeFalse();
    });
});

describe('->length', function (): void {
    it('should returns 0', function (): void {
        $failure = Failure::getInstance();
        expect($failure->length())->toBe(0);
    });
});

describe('->value', function (): void {
    it('should throws LogicException', function (): void {
        $failure = Failure::getInstance();
        expect(fn () => $failure->value())->toThrow(new \LogicException('There is no value.'));
    });
});
