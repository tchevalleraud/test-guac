<?php
    namespace Tchevalleraud\GNS3;

    class Project {

        private $auto_close;
        private $auto_open;
        private $auto_start;
        private $drawing_grid_size;
        private $filename;
        private $grid_size;
        private $name;
        private $path;
        private $project_id;
        private $scene_height;
        private $scene_width;
        private $show_grid;
        private $show_interface_labels;
        private $show_layers;
        private $snap_to_grid;
        private $status;
        private $supplier;
        private $variables;
        private $zoom;

        public function __construct(string $name){
            $this->setName($name);
        }

        public function getJson(){
            $data = [];
            if(!is_null($this->getAutoClose())) $data['auto_close'] = $this->getAutoClose();
            if(!is_null($this->getDrawingGridSize())) $data['drawing_grid_size'] = $this->getDrawingGridSize();
            if(!is_null($this->getGridSize())) $data['grid_size'] = $this->getGridSize();
            if(!is_null($this->getName())) $data['name'] = $this->getName();
            if(!is_null($this->getPath())) $data['path'] = $this->getPath();
            if(!is_null($this->getProjectId())) $data['project_id'] = $this->getProjectId();
            if(!is_null($this->getSceneHeight())) $data['scene_height'] = $this->getSceneHeight();
            if(!is_null($this->getSceneWidth())) $data['scene_width'] = $this->getSceneHeight();
            if(!is_null($this->getShowGrid())) $data['show_grid'] = $this->getShowGrid();
            if(!is_null($this->getShowInterfaceLabels())) $data['show_interface_labels'] = $this->getShowInterfaceLabels();
            if(!is_null($this->getShowLayers())) $data['show_layers'] = $this->getShowLayers();
            if(!is_null($this->getSnapToGrid())) $data['snap_to_grid'] = $this->getSnapToGrid();
            if(!is_null($this->getSupplier())) $data['supplier'] = $this->getSupplier();
            if(!is_null($this->getVariables())) $data['variables'] = $this->getVariables();
            if(!is_null($this->getZoom())) $data['zoom'] = $this->getZoom();
            return $data;
        }

        public function setJson(array $json){
            $this->setAutoClose($json['auto_close']);
            $this->setAutoOpen($json['auto_open']);
            $this->setAutoStart($json['auto_start']);
            $this->setDrawingGridSize($json['drawing_grid_size']);
            $this->setFilename($json['filename']);
            $this->setGridSize($json['grid_size']);
            $this->setName($json['name']);
            $this->setPath($json['path']);
            $this->setProjectId($json['project_id']);
            $this->setSceneHeight($json['scene_height']);
            $this->setSceneWidth($json['scene_width']);
            $this->setShowGrid($json['show_grid']);
            $this->setShowInterfaceLabels($json['show_interface_labels']);
            $this->setShowLayers($json['show_layers']);
            $this->setSnapToGrid($json['snap_to_grid']);
            $this->setStatus($json['status']);
            $this->setSupplier($json['supplier']);
            $this->setVariables($json['variables']);
            $this->setZoom($json['zoom']);
            return $this;
        }

        public function getAutoClose() {
            return $this->auto_close;
        }

        public function setAutoClose($auto_close) {
            $this->auto_close = $auto_close;
            return $this;
        }

        public function getAutoOpen() {
            return $this->auto_open;
        }

        public function setAutoOpen($auto_open) {
            $this->auto_open = $auto_open;
            return $this;
        }

        public function getAutoStart() {
            return $this->auto_start;
        }

        public function setAutoStart($auto_start) {
            $this->auto_start = $auto_start;
            return $this;
        }

        public function getDrawingGridSize() {
            return $this->drawing_grid_size;
        }

        public function setDrawingGridSize($drawing_grid_size) {
            $this->drawing_grid_size = $drawing_grid_size;
            return $this;
        }

        public function getFilename() {
            return $this->filename;
        }

        public function setFilename($filename) {
            $this->filename = $filename;
            return $this;
        }

        public function getGridSize() {
            return $this->grid_size;
        }

        public function setGridSize($grid_size) {
            $this->grid_size = $grid_size;
            return $this;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setName(string $name) {
            $this->name = $name;
            return $this;
        }

        public function getPath() {
            return $this->path;
        }

        public function setPath($path) {
            $this->path = $path;
            return $this;
        }

        public function getProjectId() {
            return $this->project_id;
        }

        public function setProjectId($project_id) {
            $this->project_id = $project_id;
            return $this;
        }

        public function getSceneHeight() {
            return $this->scene_height;
        }

        public function setSceneHeight($scene_height) {
            $this->scene_height = $scene_height;
            return $this;
        }

        public function getSceneWidth() {
            return $this->scene_width;
        }

        public function setSceneWidth($scene_width) {
            $this->scene_width = $scene_width;
            return $this;
        }

        public function getShowGrid() {
            return $this->show_grid;
        }

        public function setShowGrid($show_grid) {
            $this->show_grid = $show_grid;
            return $this;
        }

        public function getShowInterfaceLabels() {
            return $this->show_interface_labels;
        }

        public function setShowInterfaceLabels($show_interface_labels) {
            $this->show_interface_labels = $show_interface_labels;
            return $this;
        }

        public function getShowLayers() {
            return $this->show_layers;
        }

        public function setShowLayers($show_layers) {
            $this->show_layers = $show_layers;
            return $this;
        }

        public function getSnapToGrid() {
            return $this->snap_to_grid;
        }

        public function setSnapToGrid($snap_to_grid) {
            $this->snap_to_grid = $snap_to_grid;
            return $this;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
            return $this;
        }

        public function getSupplier() {
            return $this->supplier;
        }

        public function setSupplier($supplier) {
            $this->supplier = $supplier;
            return $this;
        }

        public function getVariables() {
            return $this->variables;
        }

        public function setVariables($variables) {
            $this->variables = $variables;
            return $this;
        }

        public function getZoom() {
            return $this->zoom;
        }

        public function setZoom($zoom) {
            $this->zoom = $zoom;
            return $this;
        }

    }