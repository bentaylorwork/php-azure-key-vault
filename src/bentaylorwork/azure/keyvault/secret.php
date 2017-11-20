<?php

/*
*
* Very Basic Wrapper For Accessing Secrets in an Azure Key Vault.
* 
* http://www.bentaylor.work
* http://github.com/bentaylorwork
*
* @author Ben Taylor <ben@bentaylor.work>
* @date 2017-11-18
*
*/

namespace bentaylorwork\azure\keyvault;

class Secret extends Vault
{
    public function __construct(array $keyVaultDetails)
    {
        parent::__construct($keyVaultDetails);
    }

    /*
    * Adds a secret to Azure Key Vault.
    * If the secret name exists it creates a new version under the same secret name.
    */

    public function addUpdate(string $secretName, string $secretValue)
    {
        $apiCall = "secrets/{$secretName}?api-version=2016-10-01";

        $options = [
            'value' => $secretValue
        ];

        return $this->requestApi('PUT', $apiCall, $options);
    }

    /*
    * Deletes a secret from an Azure Key Vault
    */

    public function delete(string $secretName)
    {
        $apiCall = "secrets/{$secretName}?api-version=2016-10-01";

        return $this->requestApi('DELETE', $apiCall);
    }

    /*
    * Gets the latest secret from an Azure Key Vault
    */

    public function get(string $secretName, string $version = null)
    {
        $apiCall = "secrets/{$secretName}?api-version=2016-10-01";

        if (!$version === null) {
            // if version is full URL extract version from it
            if (filter_var($version, FILTER_VALIDATE_URL)) {
                $urlExplode = explode('/', rtrim($version, '/'));
                $version = array_pop($urlExplode);
            }

            $apiCall = "secrets/{$secretName}/{$version}?api-version=2016-10-01";
        }

        return $this->requestApi('GET', $apiCall);
    }

    /*
    * Lists the last 25 versions of a secret
    */

    public function listVersions(string $secretName, int $maxResults = null)
    {
        if ($maxResults === null || $maxResults >= 26) {
            $maxResults = 25;
        }

        $apiCall = "secrets/{$secretName}/versions?api-version=2016-10-01&{$maxResults}";

        return $this->requestApi('GET', $apiCall);
    }
}
