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

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\EveOnlineResourceOwner;

final class EveOnlineResourceOwnerTest extends GenericOAuth2ResourceOwnerTest
{
    protected string $resourceOwnerClass = EveOnlineResourceOwner::class;
    protected string $userResponse = <<<json
{
    "CharacterID": "1",
    "CharacterName": "bar"
}
json;

    protected array $paths = [
        'identifier' => 'CharacterID',
        'nickname' => 'CharacterName',
        'realname' => 'CharacterName',
    ];
}
