<?php
    namespace Tchevalleraud\Apache\Guacamole;

    class Connection {

        private $server;

        public function __construct(Guacamole $server){
            $this->server = $server;
        }

        public function createSSH(string $name, string $hostname, string $username, string $password, string $parentIdentifier = "ROOT", int $port = 22, array $attributes = []){
            $endpoint = '/api/session/data/' . $this->server->getDataSource() . '/connections';

            $params = [
                'hostname'  => $hostname,
                'username'  => $username,
                'port'      => $port,
                'password'  => $password
            ];


            return $this->server->request("POST", $endpoint, [
                'json'  => [
                    'parentIdentifier'  => $parentIdentifier,
                    'name'              => $name,
                    'protocol'          => 'ssh',
                    'attributes'        => (object) $attributes,
                    'parameters'        => (object) $params
                ]
            ]);
        }

        public function createTelnet(string $name, string $hostname, string $parentIdentifier = "ROOT", int $port = 23, array $attributes = []){
            $endpoint = '/api/session/data/' . $this->server->getDataSource() . '/connections';

            $params = [
                'hostname'  => $hostname,
                'port'      => $port,
            ];


            return $this->server->request("POST", $endpoint, [
                'json'  => [
                    'parentIdentifier'  => $parentIdentifier,
                    'name'              => $name,
                    'protocol'          => 'telnet',
                    'attributes'        => (object) $attributes,
                    'parameters'        => (object) $params
                ]
            ]);
        }

    }