<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2017 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose\Component\Signature\Algorithm;

use Jose\Component\Core\JWK;

/**
 * This class is an abstract class that implements the none algorithm (plaintext).
 */
final class None implements SignatureAlgorithmInterface
{
    /**
     * {@inheritdoc}
     */
    public function allowedKeyTypes(): array
    {
        return ['none'];
    }

    /**
     * {@inheritdoc}
     */
    public function sign(JWK $key, string $input): string
    {
        $this->checkKey($key);

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function verify(JWK $key, string $input, string $signature): bool
    {
        return $signature === '';
    }

    /**
     * @param JWK $key
     */
    private function checkKey(JWK $key)
    {
        if ('none' !== $key->get('kty')) {
            throw new \InvalidArgumentException('Wrong key type.');
        }
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return 'none';
    }
}