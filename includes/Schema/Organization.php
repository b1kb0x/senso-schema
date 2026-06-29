<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Node;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Organization node.
 */
final class Organization extends Node
{
    public function toArray(): array
    {
        return $this->clean([

            '@type' => 'Organization',

            '@id' => Config::id('organization'),

            'name' => Config::get('organization.name'),

            'url' => Config::get('website.url'),

            'logo' => [

                '@id' => Config::id('logo'),

            ],

            'image' => [

                '@id' => Config::id('logo'),

            ],

            'hasMerchantReturnPolicy' => [

                '@type' => 'MerchantReturnPolicy',

                'applicableCountry' => Config::MERCHANT_RETURN_POLICY['country'],

                'returnPolicyCategory' => Config::MERCHANT_RETURN_POLICY['category'],

                'merchantReturnDays' => Config::MERCHANT_RETURN_POLICY['days'],

            ],

            'sameAs' => Config::get('organization.sameAs'),

            'telephone' => Config::get('organization.telephone'),

            'email' => Config::get('organization.email'),

        ]);
    }
}