<?php
    namespace Tchevalleraud\Apache\Guacamole;

    class ConnectionGroup {

        private $server;

        public function __construct(Guacamole $server){
            $this->server = $server;
        }

        public function create(string $name, string $parentIdentifier = "ROOT", string $type = 'ORGANIZATIONAL', array $attributes = []){
            $endpoint   = "/api/session/data/". $this->server->getDataSource() ."/connectionGroups";

            return $this->server->request("POST", $endpoint, [
                'json'  => [
                    'parentIdentifier'  => $parentIdentifier,
                    'name'              => $name,
                    'type'              => $type,
                    'attributes'        => (object) $attributes
                ]
            ]);
        }

        public function delete(string $name, string $parentIdentifier = "ROOT"){
            $connection = $this->search($name, $parentIdentifier);
            if($connection){
                $endpoint   = "/api/session/data/". $this->server->getDataSource() ."/connectionGroups/". $connection['identifier'];

                $this->server->request("DELETE", $endpoint);
            }
        }

        public function list(){
            $endpoint   = "/api/session/data/". $this->server->getDataSource() ."/connectionGroups";
            $res        = $this->server->request("GET", $endpoint);

            return $res === '' ? [] : $res;
        }

        public function search(string $name, string $parentIdentifier = "ROOT"){
            foreach ($this->list() as $connection){
                if($connection['name'] == $name && $connection['parentIdentifier'] == $parentIdentifier){
                    return $connection;
                }
            }
        }

    }