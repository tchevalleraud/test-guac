<?php
    require_once "./vendor/autoload.php";

    $projectName = "Extreme Networks - Formation SPBm";

    $gns3   = new \Tchevalleraud\GNS3\GNS3("192.168.1.50");
    $config = [
        'RTR-BCB-01'        => ['ip' => '192.168.1.151', 'pod' => 0, 'model' => '5520-24X', 'serial' => '05520-00151', 'vims' => '5520-VIM-4XE'],
        'RTR-BCB-02'        => ['ip' => '192.168.1.152', 'pod' => 0, 'model' => '5520-24X', 'serial' => '05520-00152', 'vims' => '5520-VIM-4XE'],
        'RTR-DC1-01'        => ['ip' => '192.168.1.131', 'pod' => 1, 'model' => '5520-24X', 'serial' => '05520-10131', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE1-01'      => ['ip' => '192.168.1.132', 'pod' => 1, 'model' => '5520-24X', 'serial' => '05520-10132', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE1-02'      => ['ip' => '192.168.1.133', 'pod' => 1, 'model' => '5520-24X', 'serial' => '05520-10133', 'vims' => '5520-VIM-4XE'],
        'RTR-ACCESS1-01'    => ['ip' => '192.168.1.134', 'pod' => 1, 'model' => '5420M-24W-4YE', 'serial' => '05420-10134'],
        'RTR-ACCESS1-02'    => ['ip' => '192.168.1.135', 'pod' => 1, 'model' => '5420M-24W-4YE', 'serial' => '05420-10135'],
        'RTR-DC2-01'        => ['ip' => '192.168.1.136', 'pod' => 2, 'model' => '5520-24X', 'serial' => '05520-20136', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE2-01'      => ['ip' => '192.168.1.137', 'pod' => 2, 'model' => '5520-24X', 'serial' => '05520-20137', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE2-02'      => ['ip' => '192.168.1.138', 'pod' => 2, 'model' => '5520-24X', 'serial' => '05520-20138', 'vims' => '5520-VIM-4XE'],
        'RTR-ACCESS2-01'    => ['ip' => '192.168.1.139', 'pod' => 2, 'model' => '5420M-24W-4YE', 'serial' => '05420-20139'],
        'RTR-ACCESS2-02'    => ['ip' => '192.168.1.140', 'pod' => 2, 'model' => '5420M-24W-4YE', 'serial' => '05420-20140'],
        'RTR-DC3-01'        => ['ip' => '192.168.1.141', 'pod' => 3, 'model' => '5520-24X', 'serial' => '05520-30141', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE3-01'      => ['ip' => '192.168.1.142', 'pod' => 3, 'model' => '5520-24X', 'serial' => '05520-30142', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE3-02'      => ['ip' => '192.168.1.143', 'pod' => 3, 'model' => '5520-24X', 'serial' => '05520-30143', 'vims' => '5520-VIM-4XE'],
        'RTR-ACCESS3-01'    => ['ip' => '192.168.1.144', 'pod' => 3, 'model' => '5420M-24W-4YE', 'serial' => '05420-30144'],
        'RTR-ACCESS3-02'    => ['ip' => '192.168.1.145', 'pod' => 3, 'model' => '5420M-24W-4YE', 'serial' => '05420-30145'],
        'RTR-DC4-01'        => ['ip' => '192.168.1.146', 'pod' => 4, 'model' => '5520-24X', 'serial' => '05520-40146', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE4-01'      => ['ip' => '192.168.1.147', 'pod' => 4, 'model' => '5520-24X', 'serial' => '05520-40147', 'vims' => '5520-VIM-4XE'],
        'RTR-CORE4-02'      => ['ip' => '192.168.1.148', 'pod' => 4, 'model' => '5520-24X', 'serial' => '05520-40148', 'vims' => '5520-VIM-4XE'],
        'RTR-ACCESS4-01'    => ['ip' => '192.168.1.149', 'pod' => 4, 'model' => '5420M-24W-4YE', 'serial' => '05420-40149'],
        'RTR-ACCESS4-02'    => ['ip' => '192.168.1.150', 'pod' => 4, 'model' => '5420M-24W-4YE', 'serial' => '05420-40150'],
        'PC1'              => ['pod' => 1],
        'PC2'              => ['pod' => 1],
        'PC3'              => ['pod' => 1],
        'PC4'              => ['pod' => 1],
        'PC5'              => ['pod' => 2],
        'PC6'              => ['pod' => 2],
        'PC7'              => ['pod' => 2],
        'PC8'              => ['pod' => 2],
        'PC9'              => ['pod' => 3],
        'PC10'              => ['pod' => 3],
        'PC11'              => ['pod' => 3],
        'PC12'              => ['pod' => 3],
        'PC13'              => ['pod' => 4],
        'PC14'              => ['pod' => 4],
        'PC15'              => ['pod' => 4],
        'PC16'              => ['pod' => 4],
    ];
    $hostGuac   = "https://guacamole.pwsb.fr";
    $username   = "tchevalleraud";
    $password   = "tnt_xzw7FJV8vwx8tfx";

    $cloud  = $gns3->searchTemplate("Cloud");
    $vVOSS0 = $gns3->searchTemplate("Extreme Networks - DT VOSS 8.10.0");
    $vVOSS1 = $gns3->searchTemplate("Extreme Networks - DT VOSS 8.10.0", 1);

    $project = new \Tchevalleraud\GNS3\Project($projectName);
    $project->setShowGrid(false);

    $gns3->deleteProject($project);
    $gns3->createProject($project);

    /**
     * NODES
     */
    //POD 1
    $RTR_DC1_01     = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-DC1-01', 'x' => -600, 'y'=> -300]);
    $RTR_CORE1_01   = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-CORE1-01', 'x' => -800, 'y'=> -500]);
    $RTR_CORE1_02   = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-CORE1-02', 'x' => -400, 'y'=> -500]);
    $RTR_ACCESS1_01 = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-ACCESS1-01', 'x' => -800, 'y'=> -700]);
    $RTR_ACCESS1_02 = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-ACCESS1-02', 'x' => -400, 'y'=> -700]);
    //POD 2
    $RTR_DC2_01     = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-DC2-01', 'x' => 600, 'y'=> -300]);
    $RTR_CORE2_01   = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-CORE2-01', 'x' => 400, 'y'=> -500]);
    $RTR_CORE2_02   = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-CORE2-02', 'x' => 800, 'y'=> -500]);
    $RTR_ACCESS2_01 = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-ACCESS2-01', 'x' => 400, 'y'=> -700]);
    $RTR_ACCESS2_02 = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-ACCESS2-02', 'x' => 800, 'y'=> -700]);
    //POD 3
    $RTR_DC3_01     = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-DC3-01', 'x' => -600, 'y'=> 300]);
    $RTR_CORE3_01   = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-CORE3-01', 'x' => -800, 'y'=> 500]);
    $RTR_CORE3_02   = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-CORE3-02', 'x' => -400, 'y'=> 500]);
    $RTR_ACCESS3_01 = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-ACCESS3-01', 'x' => -800, 'y'=> 700]);
    $RTR_ACCESS3_02 = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-ACCESS3-02', 'x' => -400, 'y'=> 700]);
    //POD 4
    $RTR_DC4_01     = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-DC4-01', 'x' => 600, 'y'=> 300]);
    $RTR_CORE4_01   = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-CORE4-01', 'x' => 400, 'y'=> 500]);
    $RTR_CORE4_02   = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-CORE4-02', 'x' => 800, 'y'=> 500]);
    $RTR_ACCESS4_01 = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-ACCESS4-01', 'x' => 400, 'y'=> 700]);
    $RTR_ACCESS4_02 = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-ACCESS4-02', 'x' => 800, 'y'=> 700]);;

    //POD 0
    $RTR_BCB_01     = $gns3->createTemplateNode($project, $vVOSS0, ['name' => 'RTR-BCB-01', 'x' => -300, 'y'=> 0]);
    $RTR_BCB_02     = $gns3->createTemplateNode($project, $vVOSS1, ['name' => 'RTR-BCB-02', 'x' => 300, 'y'=> 0]);

    //vPC
    $vPC1   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC1', 'node_type' => 'vpcs', 'x' => -900, 'y' => -900]));
    $vPC2   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC2', 'node_type' => 'vpcs', 'x' => -700, 'y' => -900]));
    $vPC3   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC3', 'node_type' => 'vpcs', 'x' => -500, 'y' => -900]));
    $vPC4   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC4', 'node_type' => 'vpcs', 'x' => -300, 'y' => -900]));
    $vPC5   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC5', 'node_type' => 'vpcs', 'x' => 300, 'y' => -900]));
    $vPC6   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC6', 'node_type' => 'vpcs', 'x' => 500, 'y' => -900]));
    $vPC7   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC7', 'node_type' => 'vpcs', 'x' => 700, 'y' => -900]));
    $vPC8   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'PC8', 'node_type' => 'vpcs', 'x' => 900, 'y' => -900]));
    $vPC9   = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC9', 'node_type' => 'vpcs', 'x' => -900, 'y' => 900]));
    $vPC10  = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC10', 'node_type' => 'vpcs', 'x' => -700, 'y' => 900]));
    $vPC11  = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC11', 'node_type' => 'vpcs', 'x' => -500, 'y' => 900]));
    $vPC12  = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC12', 'node_type' => 'vpcs', 'x' => -300, 'y' => 900]));
    $vPC13  = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC13', 'node_type' => 'vpcs', 'x' => 300, 'y' => 900]));
    $vPC14  = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC14', 'node_type' => 'vpcs', 'x' => 500, 'y' => 900]));
    $vPC15  = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC15', 'node_type' => 'vpcs', 'x' => 700, 'y' => 900]));
    $vPC16  = $gns3->createNode($project, new \Tchevalleraud\GNS3\Node(['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'PC16', 'node_type' => 'vpcs', 'x' => 900, 'y' => 900]));

    // Management
    $MGMT_RTR_DC1_01        = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_DC1_01', 'x' => -1100, 'y' => -300]);
    $MGMT_RTR_CORE1_01      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_CORE1_01', 'x' => -1100, 'y' => -500]);
    $MGMT_RTR_CORE1_02      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_CORE1_02', 'x' => -1100, 'y' => -400]);
    $MGMT_RTR_ACCESS1_01    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS1_01', 'x' => -1100, 'y' => -700]);
    $MGMT_RTR_ACCESS1_02    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS1_02', 'x' => -1100, 'y' => -600]);
    $MGMT_RTR_DC2_01        = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_DC2_01', 'x' => 1100, 'y' => -300]);
    $MGMT_RTR_CORE2_01      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_CORE2_01', 'x' => 1100, 'y' => -400]);
    $MGMT_RTR_CORE2_02      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_CORE2_02', 'x' => 1100, 'y' => -500]);
    $MGMT_RTR_ACCESS2_01    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS2_01', 'x' => 1100, 'y' => -600]);
    $MGMT_RTR_ACCESS2_02    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS2_02', 'x' => 1100, 'y' => -700]);
    $MGMT_RTR_DC3_01        = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_DC3_01', 'x' => -1100, 'y' => 300]);
    $MGMT_RTR_CORE3_01      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_CORE3_01', 'x' => -1100, 'y' => 500]);
    $MGMT_RTR_CORE3_02      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_CORE3_02', 'x' => -1100, 'y' => 400]);
    $MGMT_RTR_ACCESS3_01    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS3_01', 'x' => -1100, 'y' => 700]);
    $MGMT_RTR_ACCESS3_02    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS3_02', 'x' => -1100, 'y' => 600]);
    $MGMT_RTR_DC4_01        = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_DC4_01', 'x' => 1100, 'y' => 300]);
    $MGMT_RTR_CORE4_01      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_CORE4_01', 'x' => 1100, 'y' => 400]);
    $MGMT_RTR_CORE4_02      = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_CORE4_02', 'x' => 1100, 'y' => 500]);
    $MGMT_RTR_ACCESS4_01    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS4_01', 'x' => 1100, 'y' => 600]);
    $MGMT_RTR_ACCESS4_02    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_ACCESS4_02', 'x' => 1100, 'y' => 700]);

    $MGMT_RTR_BCB_01    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_BCB_01', 'x' => -1100, 'y' => 0]);
    $MGMT_RTR_BCB_02    = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(1)->getComputeId(), 'name' => 'MGMT_RTR_BCB_02', 'x' => 1100, 'y' => 0]);


    /**
     * LINKS
     */
    //POD 0
    $gns3->createLink($project, $RTR_BCB_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_DC1_01, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_BCB_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_DC3_01, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_BCB_02, ['adapter_number' => 1, 'port_number' => 0], $RTR_DC2_01, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_BCB_02, ['adapter_number' => 2, 'port_number' => 0], $RTR_DC4_01, ['adapter_number' => 5, 'port_number' => 0]);
    //INTERCO
    $gns3->createLink($project, $RTR_DC1_01, ['adapter_number' => 3, 'port_number' => 0], $RTR_DC3_01, ['adapter_number' => 3, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_DC1_01, ['adapter_number' => 4, 'port_number' => 0], $RTR_DC2_01, ['adapter_number' => 4, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_DC2_01, ['adapter_number' => 3, 'port_number' => 0], $RTR_DC4_01, ['adapter_number' => 3, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_DC3_01, ['adapter_number' => 4, 'port_number' => 0], $RTR_DC4_01, ['adapter_number' => 4, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_01, ['adapter_number' => 6, 'port_number' => 0], $RTR_CORE3_01, ['adapter_number' => 6, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_02, ['adapter_number' => 6, 'port_number' => 0], $RTR_CORE2_01, ['adapter_number' => 6, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE2_02, ['adapter_number' => 6, 'port_number' => 0], $RTR_CORE4_02, ['adapter_number' => 6, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE3_02, ['adapter_number' => 6, 'port_number' => 0], $RTR_CORE4_01, ['adapter_number' => 6, 'port_number' => 0]);
    //POD 1
    $gns3->createLink($project, $RTR_DC1_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE1_01, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_DC1_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE1_02, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE1_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE1_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_01, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS1_01, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_01, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS1_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_02, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS1_01, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE1_02, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS1_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS1_01, ['adapter_number' => 3, 'port_number' => 0], $vPC1, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS1_01, ['adapter_number' => 4, 'port_number' => 0], $vPC2, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS1_02, ['adapter_number' => 3, 'port_number' => 0], $vPC3, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS1_02, ['adapter_number' => 4, 'port_number' => 0], $vPC4, ['adapter_number' => 0, 'port_number' => 0]);
    //POD 2
    $gns3->createLink($project, $RTR_DC2_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE2_01, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_DC2_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE2_02, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE2_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE2_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE2_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE2_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE2_01, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS2_01, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE2_01, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS2_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE2_02, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS2_01, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE2_02, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS2_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS2_01, ['adapter_number' => 3, 'port_number' => 0], $vPC5, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS2_01, ['adapter_number' => 4, 'port_number' => 0], $vPC6, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS2_02, ['adapter_number' => 3, 'port_number' => 0], $vPC7, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS2_02, ['adapter_number' => 4, 'port_number' => 0], $vPC8, ['adapter_number' => 0, 'port_number' => 0]);
    //POD 3
    $gns3->createLink($project, $RTR_DC3_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE3_01, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_DC3_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE3_02, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE3_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE3_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE3_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE3_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE3_01, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS3_01, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE3_01, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS3_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE3_02, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS3_01, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE3_02, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS3_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS3_01, ['adapter_number' => 3, 'port_number' => 0], $vPC9, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS3_01, ['adapter_number' => 4, 'port_number' => 0], $vPC10, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS3_02, ['adapter_number' => 3, 'port_number' => 0], $vPC11, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS3_02, ['adapter_number' => 4, 'port_number' => 0], $vPC12, ['adapter_number' => 0, 'port_number' => 0]);
    //POD4
    $gns3->createLink($project, $RTR_DC4_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE4_01, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_DC4_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE4_02, ['adapter_number' => 5, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE4_01, ['adapter_number' => 1, 'port_number' => 0], $RTR_CORE4_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE4_01, ['adapter_number' => 2, 'port_number' => 0], $RTR_CORE4_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE4_01, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS4_01, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE4_01, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS4_02, ['adapter_number' => 1, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE4_02, ['adapter_number' => 3, 'port_number' => 0], $RTR_ACCESS4_01, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_CORE4_02, ['adapter_number' => 4, 'port_number' => 0], $RTR_ACCESS4_02, ['adapter_number' => 2, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS4_01, ['adapter_number' => 3, 'port_number' => 0], $vPC13, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS4_01, ['adapter_number' => 4, 'port_number' => 0], $vPC14, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS4_02, ['adapter_number' => 3, 'port_number' => 0], $vPC15, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $RTR_ACCESS4_02, ['adapter_number' => 4, 'port_number' => 0], $vPC16, ['adapter_number' => 0, 'port_number' => 0]);
    //Management
    $gns3->createLink($project, $MGMT_RTR_DC1_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_DC1_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE1_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE1_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE1_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE1_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS1_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS1_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS1_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS1_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_DC2_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_DC2_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE2_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE2_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE2_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE2_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS2_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS2_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS2_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS2_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_DC3_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_DC3_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE3_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE3_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE3_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE3_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS3_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS3_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS3_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS3_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_DC4_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_DC4_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE4_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE4_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_CORE4_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_CORE4_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS4_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS4_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_ACCESS4_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_ACCESS4_02, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_BCB_01, ['adapter_number' => 0, 'port_number' => 0], $RTR_BCB_01, ['adapter_number' => 0, 'port_number' => 0]);
    $gns3->createLink($project, $MGMT_RTR_BCB_02, ['adapter_number' => 0, 'port_number' => 0], $RTR_BCB_02, ['adapter_number' => 0, 'port_number' => 0]);

    /**
     * Guacamole & MobaXterm & Terminus
     */
    $guacamole  = new \Tchevalleraud\Apache\Guacamole\Guacamole($hostGuac, $username, $password);

    $connectionGroup    = new \Tchevalleraud\Apache\Guacamole\ConnectionGroup($guacamole);
    $connectionGroup->delete("Extreme Networks - Formation SPBm");
    $root               = $connectionGroup->create("Extreme Networks - Formation SPBm");
    $pod0               = $connectionGroup->create("ADMIN", $root['identifier']);
    $pod0Console        = $connectionGroup->create("Serial", $pod0['identifier']);
    $pod1               = $connectionGroup->create("POD1", $root['identifier']);
    $pod1Console        = $connectionGroup->create("Serial", $pod1['identifier']);
    $pod2               = $connectionGroup->create("POD2", $root['identifier']);
    $pod2Console        = $connectionGroup->create("Serial", $pod2['identifier']);
    $pod3               = $connectionGroup->create("POD3", $root['identifier']);
    $pod3Console        = $connectionGroup->create("Serial", $pod3['identifier']);
    $pod4               = $connectionGroup->create("POD4", $root['identifier']);
    $pod4Console        = $connectionGroup->create("Serial", $pod4['identifier']);

    $connection         = new \Tchevalleraud\Apache\Guacamole\Connection($guacamole);
    foreach ($config as $k => $v){
        if($v['pod'] == 0) $identifier = $pod0['identifier'];
        elseif($v['pod'] == 1) $identifier = $pod1['identifier'];
        elseif($v['pod'] == 2) $identifier = $pod2['identifier'];
        elseif($v['pod'] == 3) $identifier = $pod3['identifier'];
        elseif($v['pod'] == 4) $identifier = $pod4['identifier'];

        if(str_contains($k, "PC")){
            $node = $gns3->searchNode($project, $k);
            $ip = $gns3->searchComputes($node->getComputeId())->getHost();
            $port = $node->getConsole();

            $connection->createTelnet('v'.$node->getName(), $ip, $identifier, $port);

            $directory = $projectName."/ POD ".$v['pod'];
        } else {
            $node = $gns3->searchNode($project, $k);
            $ip = $gns3->searchComputes($node->getComputeId())->getHost();
            $port = $node->getConsole();

            $connection->createSSH($node->getName(), $v['ip'], "rwa", "rwa", $identifier);

            if($v['pod'] == 0) $identifier = $pod0Console['identifier'];
            elseif($v['pod'] == 1) $identifier = $pod1Console['identifier'];
            elseif($v['pod'] == 2) $identifier = $pod2Console['identifier'];
            elseif($v['pod'] == 3) $identifier = $pod3Console['identifier'];
            elseif($v['pod'] == 4) $identifier = $pod4Console['identifier'];

            $connection->createTelnet($node->getName()." - serial", $ip, $identifier, $port);
        }
    }

    /**
     * Start Node and init script
     */
    $nodes["RTR-BCB-01"] = $gns3->startNode($project, $RTR_BCB_01);
    $nodes["RTR-BCB-02"] = $gns3->startNode($project, $RTR_BCB_02);
    $nodes["RTR-DC1-01"] = $gns3->startNode($project, $RTR_DC1_01);
    $nodes["RTR-CORE1-01"] = $gns3->startNode($project, $RTR_CORE1_01);
    $nodes["RTR-CORE1-02"] = $gns3->startNode($project, $RTR_CORE1_02);
    $nodes["RTR-ACCESS1-01"] = $gns3->startNode($project, $RTR_ACCESS1_01);
    $nodes["RTR-ACCESS1-02"] = $gns3->startNode($project, $RTR_ACCESS1_02);
    $nodes["RTR-DC2-01"] = $gns3->startNode($project, $RTR_DC2_01);
    $nodes["RTR-CORE2-01"] = $gns3->startNode($project, $RTR_CORE2_01);
    $nodes["RTR-CORE2-02"] = $gns3->startNode($project, $RTR_CORE2_02);
    $nodes["RTR-ACCESS2-01"] = $gns3->startNode($project, $RTR_ACCESS2_01);
    $nodes["RTR-ACCESS2-02"] = $gns3->startNode($project, $RTR_ACCESS2_02);
    $nodes["RTR-DC3-01"] = $gns3->startNode($project, $RTR_DC3_01);
    $nodes["RTR-CORE3-01"] = $gns3->startNode($project, $RTR_CORE3_01);
    $nodes["RTR-CORE3-02"] = $gns3->startNode($project, $RTR_CORE3_02);
    $nodes["RTR-ACCESS3-01"] = $gns3->startNode($project, $RTR_ACCESS3_01);
    $nodes["RTR-ACCESS3-02"] = $gns3->startNode($project, $RTR_ACCESS3_02);
    $nodes["RTR-DC4-01"] = $gns3->startNode($project, $RTR_DC4_01);
    $nodes["RTR-CORE4-01"] = $gns3->startNode($project, $RTR_CORE4_01);
    $nodes["RTR-CORE4-02"] = $gns3->startNode($project, $RTR_CORE4_02);
    $nodes["RTR-ACCESS4-01"] = $gns3->startNode($project, $RTR_ACCESS4_01);
    $nodes["RTR-ACCESS4-02"] = $gns3->startNode($project, $RTR_ACCESS4_02);

    // SCRIPT CUSTOM
    for($i = (60 * 4); $i > 0; $i--){
        if($i == 60) echo $i."sec\n";
        elseif($i == 120) echo $i."sec\n";
        elseif($i == 180) echo $i."sec\n";
        elseif($i <= 10) echo $i."sec\n";
        sleep(1);
    }

    echo "Go deploy"."\n";

    while (true){
        if(sizeof($nodes) >= 1){
            foreach ($nodes as $key => $node){
                $ip = $gns3->searchComputes($node->getComputeId())->getHost();
                $port = $node->getConsole();

                try {
                    $telnet = new \miyahan\network\Telnet($ip, $port);
                    $telnet->connect();
                    $result = $telnet->exec("\r\n", false);
                    if(preg_match("#^root@[a-zA-Z0-9-]+:(.*)$#", $result)){
                        echo "config ".$key."\n";
                        $telnet->exec( 'cd /intflash');
                        $telnet->exec( 'touch __vm_config.yaml');
                        $telnet->exec( 'echo "---" >> __vm_config.yaml');
                        $telnet->exec( 'echo "system:" >> __vm_config.yaml');
                        $telnet->exec( 'echo "  license: PRD-5000-PRMR,PRD-5000-MACSEC" >> __vm_config.yaml');
                        $telnet->exec( 'echo "  slots:" >> __vm_config.yaml');
                        $telnet->exec( 'echo "    - num: 1" >> __vm_config.yaml');
                        $telnet->exec( 'echo "      type: '. $config[$key]['model'].'" >> __vm_config.yaml');
                        $telnet->exec( 'echo "      serial-number: '. $config[$key]['serial'].'" >> __vm_config.yaml');
                        if(array_key_exists('vims', $config[$key])){
                            $telnet->exec( 'echo "      vims:" >> __vm_config.yaml');
                            $telnet->exec( 'echo "        - slot: A" >> __vm_config.yaml');
                            $telnet->exec( 'echo "          type: '. $config[$key]['vims'].'" >> __vm_config.yaml');
                        }
                        $telnet->exec( 'touch config.cfg');
                        $telnet->exec( 'echo "no mgmt dhcp-client" >> config.cfg');
                        $telnet->exec( 'reboot');
                        unset($nodes[$key]);
                    }
                } catch (Exception $exception){
                    echo $exception->getMessage();
                }
            }
        } else break;
    }

    /**
     * vPC
     */
    $gns3->startNode($project, $vPC1);
    $gns3->startNode($project, $vPC2);
    $gns3->startNode($project, $vPC3);
    $gns3->startNode($project, $vPC4);
    $gns3->startNode($project, $vPC5);
    $gns3->startNode($project, $vPC6);
    $gns3->startNode($project, $vPC7);
    $gns3->startNode($project, $vPC8);
    $gns3->startNode($project, $vPC9);
    $gns3->startNode($project, $vPC10);
    $gns3->startNode($project, $vPC11);
    $gns3->startNode($project, $vPC12);
    $gns3->startNode($project, $vPC13);
    $gns3->startNode($project, $vPC14);
    $gns3->startNode($project, $vPC15);
    $gns3->startNode($project, $vPC16);