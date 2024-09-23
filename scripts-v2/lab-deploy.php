<?php
    require_once "./vendor/autoload.php";

    include_once "./scripts-v2/lab-variables.php";

    /*****
     * Datacenter configuration
     */
    print_r("%%%%% Datacenter configuration %%%%%\n");
    $gns3   = new \Tchevalleraud\GNS3\GNS3("10.201.100.121");
    $project = new \Tchevalleraud\GNS3\Project("Scaleway - ".$projectName);
    $project->setShowGrid(false);
    $project->setShowInterfaceLabels(false);
    $gns3->deleteProject($project);
    $gns3->createProject($project);
    $y = -400;
    foreach ($servers as $pod => $server){
        $wan[$pod] = $gns3->createTemplateNode($project, $gns3->searchTemplate('Cloud'));
        $wan[$pod] = $gns3->updateNode($project, $wan[$pod], ['name' => 'vers_gns3srv10'.$pod, 'x' => -300, 'y' => ($y + (($pod-1) * 100) - 20)]);
        $wan[$pod] = $gns3->updateNodeCloud($project, $wan[$pod], ['ports_mapping' => [['lport' => 40000 + $pod, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[$pod], 'rport' => 40000 + $pod, 'type' => "udp"]]]);

        $lan[$pod] = $gns3->createTemplateNode($project, $gns3->searchTemplate('POD'.$pod));
        $lan[$pod] = $gns3->updateNode($project, $lan[$pod], ['name' => 'VLAN120'.$pod, 'x' => 200, 'y' => ($y + (($pod-1) * 100) - 20)]);

        $sw[$pod] = $gns3->createTemplateNode($project, $gns3->searchTemplate('Ethernet switch'));
        $sw[$pod] = $gns3->updateNode($project, $sw[$pod], ['name' => 'sw_pod'.$pod, 'x' => 0, 'y' => ($y + (($pod-1) * 100))]);

        $gns3->createLink($project, $wan[$pod], ['adapter_number' => 0, 'port_number' => 0], $sw[$pod], ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $lan[$pod], ['adapter_number' => 0, 'port_number' => 0], $sw[$pod], ['adapter_number' => 0, 'port_number' => 1]);
        print_r(" - POD ".$pod." is configured\n");
    }
    $gns3->closeProject($project);
    print_r("\n");

    /*****
     * Scaleway configuration
     */
    print_r("%%%%% Scaleway configuration %%%%%\n");
    foreach ($servers as $pod => $server){
        print_r(" - Start configure POD ".$pod."\n");
        $gns3       = new Tchevalleraud\GNS3\GNS3($server);

        $cloud      = $gns3->searchTemplate("Cloud");
        $switch     = $gns3->searchTemplate("Ethernet switch");
        $voss       = $gns3->searchTemplate("Extreme Networks DT v8.10.4.0");
        $debian     = $gns3->searchTemplate("Debian 12.4");

        $project    = new \Tchevalleraud\GNS3\Project($projectName);
        $project->setShowGrid(false);
        $project->setShowInterfaceLabels(false);

        $gns3->deleteProject($project);
        $gns3->createProject($project);

        // Management
        $MGMT = $gns3->createTemplateNode($project, $cloud);
        $MGMT = $gns3->updateNode($project, $MGMT, ['name' => 'MGMT', 'x' => -50, 'y' => -580, 'z' => 3]);
        $MGMT = $gns3->updateNodeCloud($project, $MGMT, ['ports_mapping' => [['lport' => 40000 + $pod, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $datacenter, 'rport' => 40000 + $pod, 'type' => "udp"]]]);
        $switchlv1 = $gns3->createTemplateNode($project, $switch);
        $switchlv1 = $gns3->updateNode($project, $switchlv1, ['name'=> 'sw_mgmt', 'x' => 0, 'y' => -550, 'z' => 2]);
        print_r("   + Configure management : ok\n");

        // Cloud
        if(array_key_exists($pod+1, $servers)){
            $lport = 40000 + ($pod * 1000) + (($pod + 1) * 100);
            $rport = 40000 + (($pod + 1) * 1000) + ($pod * 100);
            $nextPod = $gns3->createTemplateNode($project, $cloud);
            $nextPod = $gns3->updateNode($project, $nextPod, ['name' => 'vers_POD'.($pod+1), 'x' => 400, 'y' => -400, 'z' => 3]);
            $nextPod = $gns3->updateNodeCloud($project, $nextPod, ['ports_mapping' => [
                ['lport' => $lport+1, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[$pod+1], 'rport' => $rport+1, 'type' => "udp"],
                ['lport' => $lport+2, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[$pod+1], 'rport' => $rport+2, 'type' => "udp"]
            ]]);
        } else {
            $lport = 40000 + ($pod * 1000) + (1 * 100);
            $rport = 40000 + (1 * 1000) + ($pod * 100);
            $nextPod = $gns3->createTemplateNode($project, $cloud);
            $nextPod = $gns3->updateNode($project, $nextPod, ['name' => 'vers_POD1', 'x' => 400, 'y' => -400, 'z' => 3]);
            $nextPod = $gns3->updateNodeCloud($project, $nextPod, ['ports_mapping' => [
                ['lport' => $lport+1, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[1], 'rport' => $rport+1, 'type' => "udp"],
                ['lport' => $lport+2, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[1], 'rport' => $rport+2, 'type' => "udp"]
            ]]);
        }

        if(array_key_exists($pod-1, $servers)){
            $lport = 40000 + ($pod * 1000) + (($pod - 1) * 100);
            $rport = 40000 + (($pod - 1) * 1000) + ($pod * 100);
            $prevPod = $gns3->createTemplateNode($project, $cloud);
            $prevPod = $gns3->updateNode($project, $prevPod, ['name' => 'vers_POD'.($pod-1), 'x' => -500, 'y' => -400, 'z' => 3]);
            $prevPod = $gns3->updateNodeCloud($project, $prevPod, ['ports_mapping' => [
                ['lport' => $lport+1, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[$pod-1], 'rport' => $rport+1, 'type' => "udp"],
                ['lport' => $lport+2, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[$pod-1], 'rport' => $rport+2, 'type' => "udp"]
            ]]);
        } else {
            $lport = 40000 + ($pod * 1000) + (sizeof($servers) * 100);
            $rport = 40000 + (sizeof($servers) * 1000) + ($pod * 100);
            $prevPod = $gns3->createTemplateNode($project, $cloud);
            $prevPod = $gns3->updateNode($project, $prevPod, ['name' => 'vers_POD'.(sizeof($servers)), 'x' => -500, 'y' => -400, 'z' => 3]);
            $prevPod = $gns3->updateNodeCloud($project, $prevPod, ['ports_mapping' => [
                ['lport' => $lport+1, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[sizeof($servers)], 'rport' => $rport+1, 'type' => "udp"],
                ['lport' => $lport+2, 'name' => "UDP tunnel 1", 'port_number' => 0, 'rhost' => $servers[sizeof($servers)], 'rport' => $rport+2, 'type' => "udp"]
            ]]);
        }
        print_r("   + Configure cloud : ok\n");

        // Devices
        $DC1        = $gns3->createTemplateNode($project, $voss);
        $DC1        = $gns3->updateNode($project, $DC1, ['name' => 'RTR-DC'.$pod.'-01', 'x' => 0, 'y' => -400, 'z' => 3]);
        $CORE1      = $gns3->createTemplateNode($project, $voss);
        $CORE1      = $gns3->updateNode($project, $CORE1, ['name' => 'RTR-CORE'.$pod.'-01', 'x' => -300, 'y' => -100, 'z' => 3]);
        $CORE1      = $gns3->updateNode($project, $CORE1, ['label' => ['text' => 'RTR-CORE'.$pod.'-01', 'x' => -110, 'y' => 15]]);
        $CORE2      = $gns3->createTemplateNode($project, $voss);
        $CORE2      = $gns3->updateNode($project, $CORE2, ['name' => 'RTR-CORE'.$pod.'-02', 'x' => 300, 'y' => -100, 'z' => 3]);
        $CORE2      = $gns3->updateNode($project, $CORE2, ['label' => ['text' => 'RTR-CORE'.$pod.'-02', 'x' => 60, 'y' => 15]]);
        $ACCESS1    = $gns3->createTemplateNode($project, $voss);
        $ACCESS1    = $gns3->updateNode($project, $ACCESS1, ['name' => 'RTR-ACCESS'.$pod.'-01', 'x' => -300, 'y' => 200, 'z' => 3]);
        $ACCESS1    = $gns3->updateNode($project, $ACCESS1, ['label' => ['text' => 'RTR-ACCESS'.$pod.'-01', 'x' => -125, 'y' => 15]]);
        $ACCESS2    = $gns3->createTemplateNode($project, $voss);
        $ACCESS2    = $gns3->updateNode($project, $ACCESS2, ['name' => 'RTR-ACCESS'.$pod.'-02', 'x' => 300, 'y' => 200, 'z' => 3]);
        $ACCESS2    = $gns3->updateNode($project, $ACCESS2, ['label' => ['text' => 'RTR-ACCESS'.$pod.'-02', 'x' => 60, 'y' => 15]]);
        $PC11       = $gns3->createTemplateNode($project, $debian);
        $PC11       = $gns3->updateNode($project, $PC11, ['name' => 'PC'.$pod.'11', 'x' => -400, 'y' => 400, 'z' => 3]);
        $PC11       = $gns3->updateNode($project, $PC11, ['label' => ['text' => 'PC'.$pod.'11', 'x' => 10, 'y' => 60]]);
        $PC21       = $gns3->createTemplateNode($project, $debian);
        $PC21       = $gns3->updateNode($project, $PC21, ['name' => 'PC'.$pod.'21', 'x' => -200, 'y' => 400, 'z' => 3]);
        $PC21       = $gns3->updateNode($project, $PC21, ['label' => ['text' => 'PC'.$pod.'21', 'x' => 10, 'y' => 60]]);
        $PC12       = $gns3->createTemplateNode($project, $debian);
        $PC12       = $gns3->updateNode($project, $PC12, ['name' => 'PC'.$pod.'12', 'x' => 200, 'y' => 400, 'z' => 3]);
        $PC12       = $gns3->updateNode($project, $PC12, ['label' => ['text' => 'PC'.$pod.'12', 'x' => 10, 'y' => 60]]);
        $PC31       = $gns3->createTemplateNode($project, $debian);
        $PC31       = $gns3->updateNode($project, $PC31, ['name' => 'PC'.$pod.'31', 'x' => 400, 'y' => 400, 'z' => 3]);
        $PC31       = $gns3->updateNode($project, $PC31, ['label' => ['text' => 'PC'.$pod.'31', 'x' => 10, 'y' => 60]]);
        print_r("   + Configure nodes : ok\n");

        // Links MGMT
        $gns3->createLink($project, $MGMT, ['adapter_number' => 0, 'port_number' => 0], $switchlv1, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $switchlv1, ['adapter_number' => 0, 'port_number' => 1], $DC1, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $switchlv1, ['adapter_number' => 0, 'port_number' => 2], $CORE1, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $switchlv1, ['adapter_number' => 0, 'port_number' => 3], $CORE2, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $switchlv1, ['adapter_number' => 0, 'port_number' => 4], $ACCESS1, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $switchlv1, ['adapter_number' => 0, 'port_number' => 5], $ACCESS2, ['adapter_number' => 0, 'port_number' => 0]);

        // Links Cloud
        $gns3->createLink($project, $DC1, ['adapter_number' => 3, 'port_number' => 0], $nextPod, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $DC1, ['adapter_number' => 4, 'port_number' => 0], $prevPod, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $CORE1, ['adapter_number' => 6, 'port_number' => 0], $prevPod, ['adapter_number' => 0, 'port_number' => 1]);
        $gns3->createLink($project, $CORE2, ['adapter_number' => 6, 'port_number' => 0], $nextPod, ['adapter_number' => 0, 'port_number' => 1]);

        // Links Devices
        $gns3->createLink($project, $DC1, ['adapter_number' => 1, 'port_number' => 0], $CORE1, ['adapter_number' => 5, 'port_number' => 0]);
        $gns3->createLink($project, $DC1, ['adapter_number' => 2, 'port_number' => 0], $CORE2, ['adapter_number' => 5, 'port_number' => 0]);
        $gns3->createLink($project, $CORE1, ['adapter_number' => 1, 'port_number' => 0], $CORE2, ['adapter_number' => 1, 'port_number' => 0]);
        $gns3->createLink($project, $CORE1, ['adapter_number' => 2, 'port_number' => 0], $CORE2, ['adapter_number' => 2, 'port_number' => 0]);
        $gns3->createLink($project, $CORE1, ['adapter_number' => 3, 'port_number' => 0], $ACCESS1, ['adapter_number' => 1, 'port_number' => 0]);
        $gns3->createLink($project, $CORE1, ['adapter_number' => 4, 'port_number' => 0], $ACCESS2, ['adapter_number' => 1, 'port_number' => 0]);
        $gns3->createLink($project, $CORE2, ['adapter_number' => 3, 'port_number' => 0], $ACCESS1, ['adapter_number' => 2, 'port_number' => 0]);
        $gns3->createLink($project, $CORE2, ['adapter_number' => 4, 'port_number' => 0], $ACCESS2, ['adapter_number' => 2, 'port_number' => 0]);
        $gns3->createLink($project, $ACCESS1, ['adapter_number' => 3, 'port_number' => 0], $PC11, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $ACCESS1, ['adapter_number' => 4, 'port_number' => 0], $PC21, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $ACCESS2, ['adapter_number' => 3, 'port_number' => 0], $PC12, ['adapter_number' => 0, 'port_number' => 0]);
        $gns3->createLink($project, $ACCESS2, ['adapter_number' => 4, 'port_number' => 0], $PC31, ['adapter_number' => 0, 'port_number' => 0]);
        print_r("   + Configure links : ok\n");

        $gns3->createDrawing($project, [
            'svg'   => "<svg width=\"1200\" height=\"1000\"><rect width=\"1200\" height=\"1000\" fill=\"#ffffff\" fill-opacity=\"1.0\" stroke-width=\"2\" stroke=\"#000000\" /></svg>",
            'x'     => -575,
            'y'     => -450,
            'z'     => 2
        ]);
        $gns3->closeProject($project);
    }
    print_r("\n");