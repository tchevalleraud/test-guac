<?php
    namespace Tchevalleraud\GNS3;

    use GuzzleHttp\Client;

    class GNS3 {

        private $client;
        private $host;

        public function __construct(string $host, array $options = [], string $scheme = "http"){
            $this->host = $host;

            $options = array_merge([
                'base_uri'  => $scheme."://".$host
            ], $options);

            $this->client = new Client($options);
        }

        /**
         * Compute
         */
        public function getComputes($id = 'local'){
            $res = $this->request("GET", "/v2/computes");
            $computes = [];
            foreach ($res as $compute) {
                $c = new Compute();
                $c->setJson($compute);
                if($c->getComputeId() == "local") $c->setHost($this->host);
                $computes[$c->getComputeId()] = $c;
            }

            if(is_null($id)) return $computes;
            else return $computes[$id];
        }

        public function searchComputes(string $id = null){
            $res = $this->request("GET", "/v2/computes");
            foreach ($res as $compute) {
                if($compute['compute_id'] == $id){
                    $c = new Compute();
                    $c->setJson($compute);
                    if($c->getComputeId() == "local") $c->setHost($this->host);
                    return $c;
                }
            }
        }

        /**
         * Drawing
         */
        public function createDrawing(Project $project, $params) {
            $res = $this->request("POST", "/v2/projects/" . $project->getProjectId() . "/drawings", ['json' => $params]);
            return $this;
        }

        /**
         * Link
         */
        public function createLink(Project $project, Node $src_node, array $src_params, Node $dst_node, array $dst_params){
            $nodes = [];
            $nodes[] = array_merge(['node_id' => $src_node->getNodeId()], $src_params);
            $nodes[] = array_merge(['node_id' => $dst_node->getNodeId()], $dst_params);

            $res = $this->request("POST", "/v2/projects/". $project->getProjectId() ."/links", [
                'json'  => [
                    'nodes' => $nodes
                ]
            ]);
        }

        /**
         * Node
         */
        public function createNode(Project $project, Node $node){
            $res = $this->request("POST", "/v2/projects/". $project->getProjectId() ."/nodes", [
                'json'  => $node->getJson()
            ]);
            $node->setJson(array_merge($res, $node->getJson()));
            return $node;
        }

        public function searchNode(Project$project, string $name){
            $res = $this->request("GET", "/v2/projects/". $project->getProjectId() ."/nodes");

            if($res){
                foreach ($res as $n){
                    if($n['name'] == $name){
                        $node = new Node($n);
                        return $node;
                    }
                }
            }
        }

        public function startNode(Project $project, Node $node){
            $res = $this->request("POST", "/v2/projects/". $project->getProjectId() ."/nodes/". $node->getNodeId()."/start");

            return $node->setJson($res);
        }

        public function updateNode(Project $project, Node $node, $params){
            $res = $this->request("PUT", "/v2/projects/". $project->getProjectId() ."/nodes/". $node->getNodeId(), [
                'json'  => $params
            ]);

            $node->setJson($res);

            return $node;
        }

        public function updateNodeCloud(Project $project, Node $node, $params){
            $res = $this->request("PUT", "/v2/compute/projects/". $project->getProjectId() ."/cloud/nodes/". $node->getNodeId(), [
                'json'  => $params
            ]);

            $node->setJson($res);

            return $node;
        }

        /**
         * Projects
         */
        public function closeProject(Project $project){
            $res = $this->request("POST", "/v2/projects/". $project->getProjectId()."/close");

            return $project;
        }

        public function createProject(Project $project){
            $res = $this->request("POST", "/v2/projects", [
                'json'  => $project->getJson()
            ]);
            $project->setJson($res);
            return $project;
        }

        public function deleteProject(Project $project){
            try {
                $tmp = $this->searchProject($project);
                $res = $this->request("DELETE", "/v2/projects/". $tmp->getProjectId());
            } catch (\Exception $exception){
                return false;
            }
            return true;
        }

        public function openProject(Project $project){
            $res = $this->request("POST", "/v2/projects/". $project->getProjectId()."/open");
            $project->setJson($res);
            return $project;
        }

        public function searchProject(Project $project){
            $res = $this->request("GET", "/v2/projects");

            if($res){
                foreach ($res as $p){
                    if($p['name'] == $project->getName()){
                        $tmp = new Project($p['name']);
                        $tmp->setJson($p);
                        return $tmp;
                    }
                }
            }

            throw new \Exception("Project not found.");
        }

        public function startNodeProject(Project $project){
            $res = $this->request("POST", "/v2/projects/". $project->getProjectId() ."/nodes/start");

            return json_decode($res);
        }

        /**
         * Template
         */
        public function searchTemplate(string $name, $compute_id = 'local'){
            $res = $this->request("GET", "/v2/templates");
            $compute = $this->getComputes($compute_id);

            foreach ($res as $r){
                if($r['compute_id'] == $compute->getComputeId()){
                    if($r['name'] == $name){
                        $template = new Template();
                        $template->setJson($r);

                        return $template;
                    }
                } elseif($r['name'] == $name){
                    $template = new Template();
                    $template->setJson($r);
                    $template->setComputeId($compute->getComputeId());

                    return $template;
                }
                /**
                if($compute_id == 0){
                    if($r['compute_id'] == 'local'){
                        if($r['name'] == $name){
                            $template = new Template();
                            $template->setJson($r);

                            return $template;
                        }
                    }
                }
                if($r['compute_id'] == $compute->getComputeId()){
                    if($r['name'] == $name){
                        $template = new Template();
                        $template->setJson($r);

                        return $template;
                    }
                }
                if($r['name'] == "Cloud"){
                    $template = new Template();
                    $template->setJson($r);
                    $template->setComputeId($compute->getComputeId());

                    return $template;
                }
                 * */
            }

            throw new \Exception("Template not found.");
        }

        public function createTemplateNode(Project $project, Template $template, $params = []){
            if(!array_key_exists("x", $params)) $params['x'] = 0;
            if(!array_key_exists("y", $params)) $params['y'] = 0;

            $res = $this->request("POST", "/v2/projects/". $project->getProjectId() ."/templates/". $template->getTemplateId(), [
                'json'  => array_merge($template->getJson(), $params)
            ]);

            $node = new Node($res);
            $this->updateNode($project, $node, $params);

            return $node;
        }

        /**
         * Other function
         */
        private function request(string $method, string $endpoint, array $options = []){
            $response = $this->client->request($method, $endpoint, $options);
            return json_decode($response->getBody()->getContents(), true) ?: (string) $response->getBody()->getContents();
        }

    }