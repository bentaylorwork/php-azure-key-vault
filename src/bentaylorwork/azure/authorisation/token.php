<?php

/*
*
* Allows you to get an access tokens from Azure AD.
*
* No Error handling on incorrect details.
*
* http://www.bentaylor.work
* http://github.com/bentaylorwork
*
* @author Ben Taylor <ben@bentaylor.work>
* @date 2017-11-18
*
*/

namespace bentaylorwork\azure\authorisation;

class Token
{
    /*
     * Get an authentication token from Azure AD for Azure Key Vault.
    */

    public static function getKeyVaultToken(array $azureAppDetails)
    {
        $guzzle = new \GuzzleHttp\Client();

        $token = $guzzle->post(
            "https://login.microsoftonline.com/{$azureAppDetails['appTenantDomainName']}/oauth2/token",
            [
                'form_params' => [
                    'client_id'     => $azureAppDetails['clientId'],
                    'client_secret' => $azureAppDetails['clientSecret'],
                    'resource'      => 'https://vault.azure.net',
                    'grant_type'    => 'client_credentials',
                ]
            ]
        )->getBody()->getContents();

        return json_decode($token, true)['access_token'];
    }
}
