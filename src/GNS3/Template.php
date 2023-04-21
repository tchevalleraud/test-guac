<?php
    namespace Tchevalleraud\GNS3;

    class Template {

        private $adapter_type;
        private $adapters;
        private $bios_image;
        private $boot_priority;
        private $builtin;
        private $category;
        private $cdrom_image;
        private $compute_id;
        private $console_auto_start;
        private $console_type;
        private $cpu_throttling;
        private $cpus;
        private $custom_adapters;
        private $default_name_format;
        private $first_port_name;
        private $hda_disk_image;
        private $hda_disk_interface;
        private $hdb_disk_image;
        private $hdb_disk_interface;
        private $hdc_disk_image;
        private $hdc_disk_interface;
        private $hdd_disk_image;
        private $hdd_disk_interface;
        private $initrd;
        private $kernel_command_line;
        private $kernel_image;
        private $legacy_networking;
        private $linked_clone;
        private $mac_address;
        private $name;
        private $on_close;
        private $options;
        private $plateform;
        private $port_name_format;
        private $port_segment_size;
        private $process_priority;
        private $qemu_path;
        private $ram;
        private $symbol;
        private $template_id;
        private $template_type;
        private $usage;

        public function getJson(){
            $data = [];
            if(!is_null($this->getName())) $data['name'] = $this->getName();
            return $data;
        }

        public function setJson(array $json){
            $this->setBuiltin($json['builtin']);
            $this->setCategory($json['category']);
            $this->setComputeId($json['compute_id']);
            $this->setDefaultNameFormat($json['default_name_format']);
            $this->setName($json['name']);
            $this->setSymbol($json['symbol']);
            $this->setTemplateId($json['template_id']);
            $this->setTemplateType($json['template_type']);
            return $this;
        }

        public function getAdapterType() {
            return $this->adapter_type;
        }

        public function setAdapterType($adapter_type) {
            $this->adapter_type = $adapter_type;
            return $this;
        }

        public function getAdapters() {
            return $this->adapters;
        }

        public function setAdapters($adapters) {
            $this->adapters = $adapters;
            return $this;
        }

        public function getBiosImage() {
            return $this->bios_image;
        }

        public function setBiosImage($bios_image) {
            $this->bios_image = $bios_image;
            return $this;
        }

        public function getBootPriority() {
            return $this->boot_priority;
        }

        public function setBootPriority($boot_priority) {
            $this->boot_priority = $boot_priority;
            return $this;
        }

        public function getBuiltin() {
            return $this->builtin;
        }

        public function setBuiltin($builtin) {
            $this->builtin = $builtin;
            return $this;
        }

        public function getCategory() {
            return $this->category;
        }

        public function setCategory($category) {
            $this->category = $category;
            return $this;
        }

        public function getCdromImage() {
            return $this->cdrom_image;
        }

        public function setCdromImage($cdrom_image) {
            $this->cdrom_image = $cdrom_image;
            return $this;
        }

        public function getComputeId() {
            return $this->compute_id;
        }

        public function setComputeId($compute_id) {
            $this->compute_id = $compute_id;
            return $this;
        }

        public function getConsoleAutoStart() {
            return $this->console_auto_start;
        }

        public function setConsoleAutoStart($console_auto_start) {
            $this->console_auto_start = $console_auto_start;
            return $this;
        }

        public function getConsoleType() {
            return $this->console_type;
        }

        public function setConsoleType($console_type) {
            $this->console_type = $console_type;
            return $this;
        }

        public function getCpuThrottling() {
            return $this->cpu_throttling;
        }

        public function setCpuThrottling($cpu_throttling) {
            $this->cpu_throttling = $cpu_throttling;
            return $this;
        }

        public function getCpus() {
            return $this->cpus;
        }

        public function setCpus($cpus) {
            $this->cpus = $cpus;
            return $this;
        }

        public function getCustomAdapters() {
            return $this->custom_adapters;
        }

        public function setCustomAdapters($custom_adapters) {
            $this->custom_adapters = $custom_adapters;
            return $this;
        }

        public function getDefaultNameFormat() {
            return $this->default_name_format;
        }

        public function setDefaultNameFormat($default_name_format) {
            $this->default_name_format = $default_name_format;
            return $this;
        }

        public function getFirstPortName() {
            return $this->first_port_name;
        }

        public function setFirstPortName($first_port_name) {
            $this->first_port_name = $first_port_name;
            return $this;
        }

        public function getHdaDiskImage() {
            return $this->hda_disk_image;
        }

        public function setHdaDiskImage($hda_disk_image) {
            $this->hda_disk_image = $hda_disk_image;
            return $this;
        }

        public function getHdaDiskInterface() {
            return $this->hda_disk_interface;
        }

        public function setHdaDiskInterface($hda_disk_interface) {
            $this->hda_disk_interface = $hda_disk_interface;
            return $this;
        }

        public function getHdbDiskImage() {
            return $this->hdb_disk_image;
        }

        public function setHdbDiskImage($hdb_disk_image) {
            $this->hdb_disk_image = $hdb_disk_image;
            return $this;
        }

        public function getHdbDiskInterface() {
            return $this->hdb_disk_interface;
        }

        public function setHdbDiskInterface($hdb_disk_interface) {
            $this->hdb_disk_interface = $hdb_disk_interface;
            return $this;
        }

        public function getHdcDiskImage() {
            return $this->hdc_disk_image;
        }

        public function setHdcDiskImage($hdc_disk_image) {
            $this->hdc_disk_image = $hdc_disk_image;
            return $this;
        }

        public function getHdcDiskInterface() {
            return $this->hdc_disk_interface;
        }

        public function setHdcDiskInterface($hdc_disk_interface) {
            $this->hdc_disk_interface = $hdc_disk_interface;
            return $this;
        }

        public function getHddDiskImage() {
            return $this->hdd_disk_image;
        }

        public function setHddDiskImage($hdd_disk_image) {
            $this->hdd_disk_image = $hdd_disk_image;
            return $this;
        }

        public function getHddDiskInterface() {
            return $this->hdd_disk_interface;
        }

        public function setHddDiskInterface($hdd_disk_interface) {
            $this->hdd_disk_interface = $hdd_disk_interface;
            return $this;
        }

        public function getInitrd() {
            return $this->initrd;
        }

        public function setInitrd($initrd) {
            $this->initrd = $initrd;
            return $this;
        }

        public function getKernelCommandLine() {
            return $this->kernel_command_line;
        }

        public function setKernelCommandLine($kernel_command_line) {
            $this->kernel_command_line = $kernel_command_line;
            return $this;
        }

        public function getKernelImage() {
            return $this->kernel_image;
        }

        public function setKernelImage($kernel_image) {
            $this->kernel_image = $kernel_image;
            return $this;
        }

        public function getLegacyNetworking() {
            return $this->legacy_networking;
        }

        public function setLegacyNetworking($legacy_networking) {
            $this->legacy_networking = $legacy_networking;
            return $this;
        }

        public function getLinkedClone() {
            return $this->linked_clone;
        }

        public function setLinkedClone($linked_clone) {
            $this->linked_clone = $linked_clone;
            return $this;
        }

        public function getMacAddress() {
            return $this->mac_address;
        }

        public function setMacAddress($mac_address) {
            $this->mac_address = $mac_address;
            return $this;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
            return $this;
        }

        public function getOnClose() {
            return $this->on_close;
        }

        public function setOnClose($on_close) {
            $this->on_close = $on_close;
            return $this;
        }

        public function getOptions() {
            return $this->options;
        }

        public function setOptions($options) {
            $this->options = $options;
            return $this;
        }

        public function getPlateform() {
            return $this->plateform;
        }

        public function setPlateform($plateform) {
            $this->plateform = $plateform;
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

        public function getProcessPriority() {
            return $this->process_priority;
        }

        public function setProcessPriority($process_priority) {
            $this->process_priority = $process_priority;
            return $this;
        }

        public function getQemuPath() {
            return $this->qemu_path;
        }

        public function setQemuPath($qemu_path) {
            $this->qemu_path = $qemu_path;
            return $this;
        }

        public function getRam() {
            return $this->ram;
        }

        public function setRam($ram) {
            $this->ram = $ram;
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

        public function getTemplateType() {
            return $this->template_type;
        }

        public function setTemplateType($template_type) {
            $this->template_type = $template_type;
            return $this;
        }

        public function getUsage() {
            return $this->usage;
        }

        public function setUsage($usage) {
            $this->usage = $usage;
            return $this;
        }

    }