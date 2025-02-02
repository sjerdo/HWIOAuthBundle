<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\OAuth\ResourceOwner;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Artem Genvald <genvaldartem@gmail.com>
 */
final class RunKeeperResourceOwner extends GenericOAuth2ResourceOwner
{
    /**
     * {@inheritdoc}
     */
    protected array $paths = [
        'realname' => 'name',
        'profilepicture' => 'medium_picture',
    ];

    /**
     * {@inheritdoc}
     */
    public function getUserResource($accessToken)
    {
        $response = $this->httpRequest(
            $this->normalizeUrl($this->options['user_resource_url']),
            null,
            ['Authorization' => 'Bearer '.$accessToken]
        );

        return $this->getResponseContent($response);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'authorization_url' => 'https://runkeeper.com/apps/authorize',
            'access_token_url' => 'https://runkeeper.com/apps/token',
            'infos_url' => 'https://api.runkeeper.com/profile',
            'user_resource_url' => 'https://api.runkeeper.com/user',
        ]);
    }
}
