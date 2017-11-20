# PHP - Azure Key Vault

## Overview
A simple Proof Of Concept wrapper for the Azure RM API making it easy to comsume Azure Key Vault Secrets and Encrypt\DeCrypt strings with a Key.

More information about Azure Key Vault can be found here: https://docs.microsoft.com/en-us/azure/key-vault/

No tests implemented.

## Usage

1) Create an Azure AD application with access to the key vault you want to interact with.
2) Install the project via composer.
3) Follow one of the examples.

## Example

More examples can be found in the examples folder.

```php
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

// get the latest value for the secret
var_dump($keyVault->get('T1'));
```

## Contributors
  - Ben Taylor