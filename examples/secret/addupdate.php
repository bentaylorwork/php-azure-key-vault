<?php

require_once '../../vendor/autoload.php';

use bentaylorwork\azure\authorisation\Token as azureAuthorisation;
use bentaylorwork\azure\keyvault\Secret as keyVaultSecret;

$keyVault = new keyVaultSecret(
    [
        'accessToken'  => azureAuthorisation::getKeyVaultToken(
            [
                'appTenantDomainName' => 'contoso.onmicrosoft.com',
                'clientId'            => '00000000-0000-0000-0000-000000000000',
                'clientSecret'        => '5Ki1PHwjbCuDqPQ2f/AAydhjdfhdsdndks7887jhjhs='
            ]
        ),
        'keyVaultName' => 'keyVaultName'
    ]
);

var_dump($keyVault->addUpdate('secretName', 'secretvalue'));
