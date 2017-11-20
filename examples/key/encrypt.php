<?php

require_once '../../vendor/autoload.php';

use bentaylorwork\azure\authorisation\Token as azureAuthorisation;
use bentaylorwork\azure\keyvault\Key as keyVaultKey;

$keyVault = new keyVaultKey(
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

var_dump($keyVault->encrypt('test1', '6974d50e90f84df98f1c8414b08c1222', 'benTaylor123'));
