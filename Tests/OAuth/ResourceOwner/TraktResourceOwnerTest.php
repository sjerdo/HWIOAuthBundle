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

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\TraktResourceOwner;

final class TraktResourceOwnerTest extends GenericOAuth2ResourceOwnerTest
{
    protected string $resourceOwnerClass = TraktResourceOwner::class;
    protected string $userResponse = <<<json
{
    "username": "georges",
    "private": false,
    "name": "Georges ABITBOL",
    "vip": false,
    "images": {
        "avatar": {
            "full": "http://path/to/image"
        }
    }
}
json;

    protected array $paths = [
        'identifier' => 'username',
        'nickname' => 'username',
        'realname' => 'name',
        'profilepicture' => 'images.avatar.full',
    ];

    public function testGetUserInformation(): void
    {
        $resourceOwner = $this->createResourceOwner(
            [],
            [],
            [
                $this->createMockResponse($this->userResponse, 'application/json; charset=utf-8'),
            ]
        );

        $accessToken = ['oauth_token' => 'token', 'oauth_token_secret' => 'secret', 'access_token' => 'token'];
        $userResponse = $resourceOwner->getUserInformation($accessToken);

        $this->assertEquals('georges', $userResponse->getUsername());
        $this->assertEquals('georges', $userResponse->getNickname());
        $this->assertEquals('Georges ABITBOL', $userResponse->getRealName());
        $this->assertEquals('http://path/to/image', $userResponse->getProfilePicture());
        $this->assertEquals($accessToken['oauth_token'], $userResponse->getAccessToken());
        $this->assertNull($userResponse->getRefreshToken());
        $this->assertNull($userResponse->getExpiresIn());
    }
}
