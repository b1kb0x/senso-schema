<?php

declare(strict_types=1);

namespace Senso\Schema\Schema;

use Senso\Schema\Core\Config;
use Senso\Schema\Core\Node;

if (!defined('ABSPATH')) {
    exit;
}

final class OnlineStore extends Node
{
    public function toArray(): array
    {
        return $this->clean([

            '@type' => 'OnlineStore',

            '@id' => Config::id('store'),

            'name' => Config::get('organization.name'),

            'description' => Config::get('store.description'),

            'url' => Config::get('website.url'),

            'logo' => [
                '@id' => Config::id('logo'),
            ],

            'image' => [
                '@id' => Config::id('logo'),
            ],

            'parentOrganization' => [
                '@id' => Config::id('organization'),
            ],

            'telephone' => Config::get('organization.telephone'),

            'email' => Config::get('organization.email'),

            'areaServed' => Config::get('store.areaServed', 'UA'),

            'hasMerchantReturnPolicy' => [

                '@type' => 'MerchantReturnPolicy',

                'applicableCountry' => Config::MERCHANT_RETURN_POLICY['country'],

                'returnPolicyCategory' => Config::MERCHANT_RETURN_POLICY['category'],

                'merchantReturnDays' => Config::MERCHANT_RETURN_POLICY['days'],

            ],

        ]);
    }
}