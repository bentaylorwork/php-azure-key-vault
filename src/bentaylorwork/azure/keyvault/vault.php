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

abstract class Vault
{
    private $accessToken;
    private $keyVault;

    public function __construct(array $keyVaultDetails)
    {
        // set connection key vault name
        $this->setKeyVaultName($keyVaultDetails['keyVaultName']);

        // set access token
        $this->accessToken = $keyVaultDetails['accessToken'];
    }

    /*
    * Set the name of the key vault you want to interact with
    */

    private function setKeyVaultName($keyVaultName)
    {
        $this->keyVault = "https://{$keyVaultName}.vault.azure.net/";
    }

    /*
    * Create the API call to the Azure RM API
    */

    protected function requestApi($method, $apiCall, $json = null)
    {
        $client = new \GuzzleHttp\Client(
            [
                'base_uri'    => $this->keyVault,
                'timeout'     => 2.0
            ]
        );

        try {
            $result = $client->request(
                $method,
                $apiCall,
                [
                    'headers' => [
                        'User-Agent'    => 'browser/1.0',
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json',
                        'Authorization' => "Bearer " . $this->accessToken
                    ],
                    'json' => $json
                ]
            );

            return $this->setOutput(
                $result->getStatusCode(),
                $result->getReasonPhrase(),
                json_decode($result->getBody()->getContents(), true)
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->setOutput(
                $e->getResponse()->getStatusCode(),
                array_shift(json_decode($e->getResponse()->getBody()->getContents(), true))
            );
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->setOutput(
                500,
                $e->getHandlerContext()['error']
            );
        }
    }

    /*
    * Create an array to control output
    */

    private function setOutput($code, $message, $data = null)
    {
        return [
                'responsecode'    => $code,
                'responseMessage' => $message,
                'data'            => $data
        ];
    }
}
