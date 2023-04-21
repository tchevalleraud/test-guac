<?php

namespace Tchevalleraud\Apache\Guacamole;

use GuzzleHttp\Client;

class Guacamole {

    private $client;
    private $dataSource;
    private $token;

    public function __construct(string $host, string $username, string $password, array $options = []){
        $options = array_merge([
            'base_uri'  => $host
        ], $options);

        $this->client       = new Client($options);
        $token              = $this->generateToken($username, $password);
        $this->token        = $token['authToken'];
        $this->dataSource   = $token['dataSource'];
    }

    private function generateToken(string $username, string $password){
        $res = $this->request('POST', '/api/tokens', [
            'form_params'   => [
                'username'      => $username,
                'password'      => $password
            ]
        ], false);
        return $res;
    }

    public function getDataSource(){
        return $this->dataSource;
    }

    public function getToken(){
        return $this->token;
    }

    public function request(string $method, string $endpoint, array $options = [], bool $useToken = true){
        $response   = null;

        if($useToken) {
            $response = $this->send($method, $endpoint, $this->withAuthToken($options));
        } else {
            $response = $this->send($method, $endpoint, $options);
        }

        return $response;
    }

    private function send(string $method, string $endpoint, array $options = []){
        $response = $this->client->request($method, $endpoint, $options);
        return json_decode($response->getBody()->getContents(), true) ?: (string) $response->getBody()->getContents();
    }

    private function withAuthToken(array $options){
        return array_merge($options, [
            'query' => ['token' => $this->token]
        ]);
    }

}