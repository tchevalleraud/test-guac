<?php

    namespace Tchevalleraud\GNS3;

    class Compute {

        private $capabilities;
        private $compute_id;
        private $connected;
        private $cpu_usage_percent;
        private $host;
        private $last_error;
        private $memory_usage_percent;
        private $name;
        private $port;
        private $protocol;
        private $user;

        public function getJson(){
            $data = [];
            return $data;
        }

        public function setJson(array $json){
            $this->setCapabilities($json['capabilities']);
            $this->setComputeId($json['compute_id']);
            $this->setConnected($json['connected']);
            $this->setCpuUsagePercent($json['cpu_usage_percent']);
            $this->setHost($json['host']);
            $this->setLastError($json['last_error']);
            $this->setMemoryUsagePercent($json['memory_usage_percent']);
            $this->setName($json['name']);
            $this->setPort($json['port']);
            $this->setProtocol($json['protocol']);
            $this->setUser($json['user']);
            return $this;
        }

        public function getCapabilities() {
            return $this->capabilities;
        }

        public function setCapabilities($capabilities) {
            $this->capabilities = $capabilities;
            return $this;
        }

        public function getComputeId() {
            return $this->compute_id;
        }

        public function setComputeId($compute_id) {
            $this->compute_id = $compute_id;
            return $this;
        }

        public function getConnected() {
            return $this->connected;
        }

        public function setConnected($connected) {
            $this->connected = $connected;
            return $this;
        }

        public function getCpuUsagePercent() {
            return $this->cpu_usage_percent;
        }

        public function setCpuUsagePercent($cpu_usage_percent) {
            $this->cpu_usage_percent = $cpu_usage_percent;
            return $this;
        }

        public function getHost() {
            return $this->host;
        }

        public function setHost($host) {
            $this->host = $host;
            return $this;
        }

        public function getLastError() {
            return $this->last_error;
        }

        public function setLastError($last_error) {
            $this->last_error = $last_error;
            return $this;
        }

        public function getMemoryUsagePercent() {
            return $this->memory_usage_percent;
        }

        public function setMemoryUsagePercent($memory_usage_percent) {
            $this->memory_usage_percent = $memory_usage_percent;
            return $this;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
            return $this;
        }

        public function getPort() {
            return $this->port;
        }

        public function setPort($port) {
            $this->port = $port;
            return $this;
        }

        public function getProtocol() {
            return $this->protocol;
        }

        public function setProtocol($protocol) {
            $this->protocol = $protocol;
            return $this;
        }

        public function getUser() {
            return $this->user;
        }

        public function setUser($user) {
            $this->user = $user;
            return $this;
        }

    }