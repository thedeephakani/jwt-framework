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

namespace Jose\Component\Encryption\Tests\RFC7520;

use Base64Url\Base64Url;
use Jose\Component\Core\JWK;
use Jose\Component\Encryption\Tests\AbstractEncryptionTest;

/**
 * @see https://tools.ietf.org/html/rfc7520#section-5.4
 *
 * @group RFC7520
 */
final class ECDH_ES_A128KWAndA128GCMEncryptionTest extends AbstractEncryptionTest
{
    /**
     * Please note that we cannot the encryption and get the same result as the example (IV, TAG and other data are always different).
     * The output given in the RFC is used and only decrypted.
     */
    public function testECDH_ES_A128KWAndA128GCMEncryption()
    {
        $expected_payload = "You can trust us to stick with you through thick and thin\xe2\x80\x93to the bitter end. And you can trust us to keep any secret of yours\xe2\x80\x93closer than you keep it yourself. But you cannot trust us to let you face trouble alone, and go off without a word. We are your friends, Frodo.";

        $private_key = JWK::create([
            'kty' => 'EC',
            'kid' => 'peregrin.took@tuckborough.example',
            'use' => 'enc',
            'crv' => 'P-384',
            'x' => 'YU4rRUzdmVqmRtWOs2OpDE_T5fsNIodcG8G5FWPrTPMyxpzsSOGaQLpe2FpxBmu2',
            'y' => 'A8-yxCHxkfBz3hKZfI1jUYMjUhsEveZ9THuwFjH2sCNdtksRJU7D5-SkgaFL1ETP',
            'd' => 'iTx2pk7wW-GqJkHcEkFQb2EFyYcO7RugmaW3mRrQVAOUiPommT0IdnYK2xDlZh-j',
        ]);

        $protected_headers = [
            'alg' => 'ECDH-ES+A128KW',
            'kid' => 'peregrin.took@tuckborough.example',
            'epk' => [
                'kty' => 'EC',
                'crv' => 'P-384',
                'x' => 'uBo4kHPw6kbjx5l0xowrd_oYzBmaz-GKFZu4xAFFkbYiWgutEK6iuEDsQ6wNdNg3',
                'y' => 'sp3p5SGhZVC2faXumI-e9JU2Mo8KpoYrFDr5yPNVtW4PgEwZOyQTA-JdaY8tb7E0',
            ],
            'enc' => 'A128GCM',
        ];

        $expected_compact_json = 'eyJhbGciOiJFQ0RILUVTK0ExMjhLVyIsImtpZCI6InBlcmVncmluLnRvb2tAdHVja2Jvcm91Z2guZXhhbXBsZSIsImVwayI6eyJrdHkiOiJFQyIsImNydiI6IlAtMzg0IiwieCI6InVCbzRrSFB3Nmtiang1bDB4b3dyZF9vWXpCbWF6LUdLRlp1NHhBRkZrYllpV2d1dEVLNml1RURzUTZ3TmROZzMiLCJ5Ijoic3AzcDVTR2haVkMyZmFYdW1JLWU5SlUyTW84S3BvWXJGRHI1eVBOVnRXNFBnRXdaT3lRVEEtSmRhWTh0YjdFMCJ9LCJlbmMiOiJBMTI4R0NNIn0.0DJjBXri_kBcC46IkU5_Jk9BqaQeHdv2.mH-G2zVqgztUtnW_.tkZuOO9h95OgHJmkkrfLBisku8rGf6nzVxhRM3sVOhXgz5NJ76oID7lpnAi_cPWJRCjSpAaUZ5dOR3Spy7QuEkmKx8-3RCMhSYMzsXaEwDdXta9Mn5B7cCBoJKB0IgEnj_qfo1hIi-uEkUpOZ8aLTZGHfpl05jMwbKkTe2yK3mjF6SBAsgicQDVCkcY9BLluzx1RmC3ORXaM0JaHPB93YcdSDGgpgBWMVrNU1ErkjcMqMoT_wtCex3w03XdLkjXIuEr2hWgeP-nkUZTPU9EoGSPj6fAS-bSz87RCPrxZdj_iVyC6QWcqAu07WNhjzJEPc4jVntRJ6K53NgPQ5p99l3Z408OUqj4ioYezbS6vTPlQ.WuGzxmcreYjpHGJoa17EBg';
        $expected_flattened_json = '{"protected":"eyJhbGciOiJFQ0RILUVTK0ExMjhLVyIsImtpZCI6InBlcmVncmluLnRvb2tAdHVja2Jvcm91Z2guZXhhbXBsZSIsImVwayI6eyJrdHkiOiJFQyIsImNydiI6IlAtMzg0IiwieCI6InVCbzRrSFB3Nmtiang1bDB4b3dyZF9vWXpCbWF6LUdLRlp1NHhBRkZrYllpV2d1dEVLNml1RURzUTZ3TmROZzMiLCJ5Ijoic3AzcDVTR2haVkMyZmFYdW1JLWU5SlUyTW84S3BvWXJGRHI1eVBOVnRXNFBnRXdaT3lRVEEtSmRhWTh0YjdFMCJ9LCJlbmMiOiJBMTI4R0NNIn0","encrypted_key":"0DJjBXri_kBcC46IkU5_Jk9BqaQeHdv2","iv":"mH-G2zVqgztUtnW_","ciphertext":"tkZuOO9h95OgHJmkkrfLBisku8rGf6nzVxhRM3sVOhXgz5NJ76oID7lpnAi_cPWJRCjSpAaUZ5dOR3Spy7QuEkmKx8-3RCMhSYMzsXaEwDdXta9Mn5B7cCBoJKB0IgEnj_qfo1hIi-uEkUpOZ8aLTZGHfpl05jMwbKkTe2yK3mjF6SBAsgicQDVCkcY9BLluzx1RmC3ORXaM0JaHPB93YcdSDGgpgBWMVrNU1ErkjcMqMoT_wtCex3w03XdLkjXIuEr2hWgeP-nkUZTPU9EoGSPj6fAS-bSz87RCPrxZdj_iVyC6QWcqAu07WNhjzJEPc4jVntRJ6K53NgPQ5p99l3Z408OUqj4ioYezbS6vTPlQ","tag":"WuGzxmcreYjpHGJoa17EBg"}';
        $expected_json = '{"recipients":[{"encrypted_key":"0DJjBXri_kBcC46IkU5_Jk9BqaQeHdv2"}],"protected":"eyJhbGciOiJFQ0RILUVTK0ExMjhLVyIsImtpZCI6InBlcmVncmluLnRvb2tAdHVja2Jvcm91Z2guZXhhbXBsZSIsImVwayI6eyJrdHkiOiJFQyIsImNydiI6IlAtMzg0IiwieCI6InVCbzRrSFB3Nmtiang1bDB4b3dyZF9vWXpCbWF6LUdLRlp1NHhBRkZrYllpV2d1dEVLNml1RURzUTZ3TmROZzMiLCJ5Ijoic3AzcDVTR2haVkMyZmFYdW1JLWU5SlUyTW84S3BvWXJGRHI1eVBOVnRXNFBnRXdaT3lRVEEtSmRhWTh0YjdFMCJ9LCJlbmMiOiJBMTI4R0NNIn0","iv":"mH-G2zVqgztUtnW_","ciphertext":"tkZuOO9h95OgHJmkkrfLBisku8rGf6nzVxhRM3sVOhXgz5NJ76oID7lpnAi_cPWJRCjSpAaUZ5dOR3Spy7QuEkmKx8-3RCMhSYMzsXaEwDdXta9Mn5B7cCBoJKB0IgEnj_qfo1hIi-uEkUpOZ8aLTZGHfpl05jMwbKkTe2yK3mjF6SBAsgicQDVCkcY9BLluzx1RmC3ORXaM0JaHPB93YcdSDGgpgBWMVrNU1ErkjcMqMoT_wtCex3w03XdLkjXIuEr2hWgeP-nkUZTPU9EoGSPj6fAS-bSz87RCPrxZdj_iVyC6QWcqAu07WNhjzJEPc4jVntRJ6K53NgPQ5p99l3Z408OUqj4ioYezbS6vTPlQ","tag":"WuGzxmcreYjpHGJoa17EBg"}';
        $expected_iv = 'mH-G2zVqgztUtnW_';
        $expected_encrypted_key = '0DJjBXri_kBcC46IkU5_Jk9BqaQeHdv2';
        $expected_ciphertext = 'tkZuOO9h95OgHJmkkrfLBisku8rGf6nzVxhRM3sVOhXgz5NJ76oID7lpnAi_cPWJRCjSpAaUZ5dOR3Spy7QuEkmKx8-3RCMhSYMzsXaEwDdXta9Mn5B7cCBoJKB0IgEnj_qfo1hIi-uEkUpOZ8aLTZGHfpl05jMwbKkTe2yK3mjF6SBAsgicQDVCkcY9BLluzx1RmC3ORXaM0JaHPB93YcdSDGgpgBWMVrNU1ErkjcMqMoT_wtCex3w03XdLkjXIuEr2hWgeP-nkUZTPU9EoGSPj6fAS-bSz87RCPrxZdj_iVyC6QWcqAu07WNhjzJEPc4jVntRJ6K53NgPQ5p99l3Z408OUqj4ioYezbS6vTPlQ';
        $expected_tag = 'WuGzxmcreYjpHGJoa17EBg';

        $jweLoader = $this->getJWELoaderFactory()->create(['ECDH-ES+A128KW'], ['A128GCM'], ['DEF'], [], ['jwe_compact', 'jwe_json_flattened', 'jwe_json_general']);

        $loaded_compact_json = $jweLoader->load($expected_compact_json);
        $loaded_compact_json = $jweLoader->decryptUsingKey($loaded_compact_json, $private_key);

        $loaded_flattened_json = $jweLoader->load($expected_flattened_json);
        $loaded_flattened_json = $jweLoader->decryptUsingKey($loaded_flattened_json, $private_key);

        $loaded_json = $jweLoader->load($expected_json);
        $loaded_json = $jweLoader->decryptUsingKey($loaded_json, $private_key);

        self::assertEquals($expected_ciphertext, Base64Url::encode($loaded_compact_json->getCiphertext()));
        self::assertEquals($protected_headers, $loaded_compact_json->getSharedProtectedHeaders());
        self::assertEquals($expected_iv, Base64Url::encode($loaded_compact_json->getIV()));
        self::assertEquals($expected_encrypted_key, Base64Url::encode($loaded_compact_json->getRecipient(0)->getEncryptedKey()));
        self::assertEquals($expected_tag, Base64Url::encode($loaded_compact_json->getTag()));

        self::assertEquals($expected_ciphertext, Base64Url::encode($loaded_flattened_json->getCiphertext()));
        self::assertEquals($protected_headers, $loaded_flattened_json->getSharedProtectedHeaders());
        self::assertEquals($expected_iv, Base64Url::encode($loaded_flattened_json->getIV()));
        self::assertEquals($expected_encrypted_key, Base64Url::encode($loaded_flattened_json->getRecipient(0)->getEncryptedKey()));
        self::assertEquals($expected_tag, Base64Url::encode($loaded_flattened_json->getTag()));

        self::assertEquals($expected_ciphertext, Base64Url::encode($loaded_json->getCiphertext()));
        self::assertEquals($protected_headers, $loaded_json->getSharedProtectedHeaders());
        self::assertEquals($expected_iv, Base64Url::encode($loaded_json->getIV()));
        self::assertEquals($expected_encrypted_key, Base64Url::encode($loaded_json->getRecipient(0)->getEncryptedKey()));
        self::assertEquals($expected_tag, Base64Url::encode($loaded_json->getTag()));

        self::assertEquals($expected_payload, $loaded_compact_json->getPayload());
        self::assertEquals($expected_payload, $loaded_flattened_json->getPayload());
        self::assertEquals($expected_payload, $loaded_json->getPayload());
    }

    /**
     * Same input as before, but we perform the encryption first.
     */
    public function testECDH_ES_A128KWAndA128GCMEncryptionBis()
    {
        $expected_payload = "You can trust us to stick with you through thick and thin\xe2\x80\x93to the bitter end. And you can trust us to keep any secret of yours\xe2\x80\x93closer than you keep it yourself. But you cannot trust us to let you face trouble alone, and go off without a word. We are your friends, Frodo.";

        $public_key = JWK::create([
            'kty' => 'EC',
            'kid' => 'peregrin.took@tuckborough.example',
            'use' => 'enc',
            'crv' => 'P-384',
            'x' => 'YU4rRUzdmVqmRtWOs2OpDE_T5fsNIodcG8G5FWPrTPMyxpzsSOGaQLpe2FpxBmu2',
            'y' => 'A8-yxCHxkfBz3hKZfI1jUYMjUhsEveZ9THuwFjH2sCNdtksRJU7D5-SkgaFL1ETP',
        ]);

        $private_key = JWK::create([
            'kty' => 'EC',
            'kid' => 'peregrin.took@tuckborough.example',
            'use' => 'enc',
            'crv' => 'P-384',
            'x' => 'YU4rRUzdmVqmRtWOs2OpDE_T5fsNIodcG8G5FWPrTPMyxpzsSOGaQLpe2FpxBmu2',
            'y' => 'A8-yxCHxkfBz3hKZfI1jUYMjUhsEveZ9THuwFjH2sCNdtksRJU7D5-SkgaFL1ETP',
            'd' => 'iTx2pk7wW-GqJkHcEkFQb2EFyYcO7RugmaW3mRrQVAOUiPommT0IdnYK2xDlZh-j',
        ]);

        $protected_headers = [
            'alg' => 'ECDH-ES+A128KW',
            'kid' => 'peregrin.took@tuckborough.example',
            'enc' => 'A128GCM',
        ];

        $jweBuilder = $this->getJWEBuilderFactory()->create(['ECDH-ES+A128KW'], ['A128GCM'], ['DEF']);
        $jweLoader = $this->getJWELoaderFactory()->create(['ECDH-ES+A128KW'], ['A128GCM'], ['DEF'], [], ['jwe_compact', 'jwe_json_flattened', 'jwe_json_general']);

        $jwe = $jweBuilder
            ->create()->withPayload($expected_payload)
            ->withSharedProtectedHeaders($protected_headers)
            ->addRecipient($public_key)
            ->build();

        $loaded_flattened_json = $jweLoader->load($this->getJWESerializerManager()->serialize('jwe_json_flattened', $jwe, 0));
        $loaded_flattened_json = $jweLoader->decryptUsingKey($loaded_flattened_json, $private_key);

        $loaded_json = $jweLoader->load($this->getJWESerializerManager()->serialize('jwe_json_general', $jwe));
        $loaded_json = $jweLoader->decryptUsingKey($loaded_json, $private_key);

        self::assertTrue(array_key_exists('epk', $loaded_flattened_json->getSharedProtectedHeaders()));

        self::assertTrue(array_key_exists('epk', $loaded_json->getSharedProtectedHeaders()));

        self::assertEquals($expected_payload, $loaded_flattened_json->getPayload());
        self::assertEquals($expected_payload, $loaded_json->getPayload());
    }
}