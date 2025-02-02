<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\Tests\OAuth\ResourceOwner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\TwitchResourceOwner;

final class TwitchResourceOwnerTest extends GenericOAuth2ResourceOwnerTest
{
    protected string $resourceOwnerClass = TwitchResourceOwner::class;
    protected string $userResponse = <<<json
{
    "_id": "1",
    "display_name": "bar",
    "name": "bar",
    "email": "foobar@example.com",
    "logo": "example.com/logo.png"
}
json;

    protected array $paths = [
        'identifier' => '_id',
        'nickname' => 'display_name',
        'realname' => 'name',
        'email' => 'email',
        'profilepicture' => 'logo',
    ];
}
