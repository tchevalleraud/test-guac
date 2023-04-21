<?php
    namespace Tchevalleraud\GNS3;

    class Node {

        private $command_line;
        private $compute_id;
        private $console;
        private $console_auto_start;
        private $console_host;
        private $console_type;
        private $custom_adapters;
        private $first_port_name;
        private $height;
        private $label;
        private $locked;
        private $name;
        private $node_directory;
        private $node_id;
        private $node_type;
        private $port_name_format;
        private $port_segment_size;
        private $ports;
        private $project_id;
        private $properties;
        private $status;
        private $symbol;
        private $template_id;
        private $width;
        private $x;
        private $y;
        private $z;

        public function __construct(array $json){
            $this->setJson($json);
        }

        public function getJson(){
            $data = [];
            if(!is_null($this->getComputeId())) $data['compute_id'] = $this->getComputeId();
            if(!is_null($this->getConsole())) $data['console'] = $this->getConsole();
            if(!is_null($this->getName())) $data['name'] = $this->getName();
            if(!is_null($this->getNodeType())) $data['node_type'] = $this->getNodeType();
            if(!is_null($this->getX())) $data['x'] = $this->getX();
            if(!is_null($this->getY())) $data['y'] = $this->getY();
            if(!is_null($this->getZ())) $data['z'] = $this->getZ();
            return $data;
        }

        public function setJson(array $json){
            if(array_key_exists("compute_id", $json)) $this->setComputeId($json['compute_id']);
            if(array_key_exists("console", $json)) $this->setConsole($json['console']);
            if(array_key_exists("name", $json)) $this->setName($json['name']);
            if(array_key_exists("node_id", $json)) $this->setNodeId($json['node_id']);
            if(array_key_exists("node_type", $json)) $this->setNodeType($json['node_type']);
            if(array_key_exists("x", $json)) $this->setX($json['x']);
            if(array_key_exists("y", $json)) $this->setY($json['y']);
            if(array_key_exists("z", $json)) $this->setZ($json['z']);
            return $this;
        }

        public function getCommandLine() {
            return $this->command_line;
        }

        public function setCommandLine($command_line) {
            $this->command_line = $command_line;
            return $this;
        }

        public function getComputeId() {
            return $this->compute_id;
        }

        public function setComputeId($compute_id) {
            $this->compute_id = $compute_id;
            return $this;
        }

        public function getConsole() {
            return $this->console;
        }

        public function setConsole($console) {
            $this->console = $console;
            return $this;
        }

        public function getConsoleAutoStart() {
            return $this->console_auto_start;
        }

        public function setConsoleAutoStart($console_auto_start) {
            $this->console_auto_start = $console_auto_start;
            return $this;
        }

        public function getConsoleHost() {
            return $this->console_host;
        }

        public function setConsoleHost($console_host) {
            $this->console_host = $console_host;
            return $this;
        }

        public function getConsoleType() {
            return $this->console_type;
        }

        public function setConsoleType($console_type) {
            $this->console_type = $console_type;
            return $this;
        }

        public function getCustomAdapters() {
            return $this->custom_adapters;
        }

        public function setCustomAdapters($custom_adapters) {
            $this->custom_adapters = $custom_adapters;
            return $this;
        }

        public function getFirstPortName() {
            return $this->first_port_name;
        }

        public function setFirstPortName($first_port_name) {
            $this->first_port_name = $first_port_name;
            return $this;
        }

        public function getHeight() {
            return $this->height;
        }

        public function setHeight($height) {
            $this->height = $height;
            return $this;
        }

        public function getLabel() {
            return $this->label;
        }

        public function setLabel($label) {
            $this->label = $label;
            return $this;
        }

        public function getLocked() {
            return $this->locked;
        }

        public function setLocked($locked) {
            $this->locked = $locked;
            return $this;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
            return $this;
        }

        public function getNodeDirectory() {
            return $this->node_directory;
        }

        public function setNodeDirectory($node_directory) {
            $this->node_directory = $node_directory;
            return $this;
        }

        public function getNodeId() {
            return $this->node_id;
        }

        public function setNodeId($node_id) {
            $this->node_id = $node_id;
            return $this;
        }

        public function getNodeType() {
            return $this->node_type;
        }

        public function setNodeType($node_type) {
            $this->node_type = $node_type;
            return $this;
        }

        public function getPortNameFormat() {
            return $this->port_name_format;
        }

        public function setPortNameFormat($port_name_format) {
            $this->port_name_format = $port_name_format;
            return $this;
        }

        public function getPortSegmentSize() {
            return $this->port_segment_size;
        }

        public function setPortSegmentSize($port_segment_size) {
            $this->port_segment_size = $port_segment_size;
            return $this;
        }

        public function getPorts() {
            return $this->ports;
        }

        public function setPorts($ports) {
            $this->ports = $ports;
            return $this;
        }

        public function getProjectId() {
            return $this->project_id;
        }

        public function setProjectId($project_id) {
            $this->project_id = $project_id;
            return $this;
        }

        public function getProperties() {
            return $this->properties;
        }

        public function setProperties($properties) {
            $this->properties = $properties;
            return $this;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
            return $this;
        }

        public function getSymbol() {
            return $this->symbol;
        }

        public function setSymbol($symbol) {
            $this->symbol = $symbol;
            return $this;
        }

        public function getTemplateId() {
            return $this->template_id;
        }

        public function setTemplateId($template_id) {
            $this->template_id = $template_id;
            return $this;
        }

        public function getWidth() {
            return $this->width;
        }

        public function setWidth($width) {
            $this->width = $width;
            return $this;
        }

        public function getX() {
            return $this->x;
        }

        public function setX($x) {
            $this->x = $x;
            return $this;
        }

        public function getY() {
            return $this->y;
        }

        public function setY($y) {
            $this->y = $y;
            return $this;
        }

        public function getZ() {
            return $this->z;
        }

        public function setZ($z) {
            $this->z = $z;
            return $this;
        }

    }