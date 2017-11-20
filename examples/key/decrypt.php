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

var_dump($keyVault->decrypt('test1', '6974d50e90f84df98f1c8414b08c1222', 'PFxOPheBL6FA4Y4QJD1KHAcU0qnwdYGWaQYl5NOTP8vGOfx1CXTaNmmRNjZ9J6lKXrkdHAZDLvIyZ4hVNdcqyuATYKsit1QrOo-mH33m1Tuqr7ceqdXkwbgjNkd6D1ngU2hb6hzhJVIUzDk6djqtVTQucgJRoiEiOI4FBzyRcr8GTAcTTG4W9cNaRrDJCElNNQTqkZU9uLaxBlaQUxv1XlNKNvye18frFN5pqCCYBMQiuLdAz0TDDauSXvITWd6unbF4uXGw5rsYMYWqt_v23xZcaiThiyXYGo4pV_IHLaAVcVKfc50qFTQIFK_7nfvoRFQ5EE55O5Rh6RWlLNEC2Q'));
