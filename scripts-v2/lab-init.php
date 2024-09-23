<?php
    require_once "./vendor/autoload.php";

    include_once "./scripts-v2/lab-variables.php";

    print_r("%%%%% Scaleway initialisation %%%%%\n");
    foreach ($servers as $pod => $server){
        print_r(" - Start initialisation POD ".$pod."\n");
        $gns3       = new Tchevalleraud\GNS3\GNS3($server);
        $project    = new \Tchevalleraud\GNS3\Project($projectName);
        $project    = $gns3->searchProject($project);
        $project    = $gns3->openProject($project);

        $nodes['RTR-DC'.$pod.'-01']     = $gns3->searchNode($project, "RTR-DC".$pod."-01");
        $nodes['RTR-CORE'.$pod.'-01']   = $gns3->searchNode($project, "RTR-CORE".$pod."-01");
        $nodes['RTR-CORE'.$pod.'-02']   = $gns3->searchNode($project, "RTR-CORE".$pod."-02");
        $nodes['RTR-ACCESS'.$pod.'-01'] = $gns3->searchNode($project, "RTR-ACCESS".$pod."-01");
        $nodes['RTR-ACCESS'.$pod.'-02'] = $gns3->searchNode($project, "RTR-ACCESS".$pod."-02");

        foreach ($nodes as $key => $node){
            $gns3->startNode($project, $nodes[$key]);
        }


        print_r("   + Waiting ... ". (60 * $waitFactor). " sec\n");
        for($i = (60 * $waitFactor); $i > 0; $i--){
            /**
            if($i == 180) echo $i."sec\n";
            elseif($i == 120) echo $i."sec\n";
            elseif($i == 60) echo $i."sec\n";
            elseif($i <= 30) echo $i."sec\n";
            **/
            sleep(1);
        }

        while(true){
            if(sizeof($nodes ) >= 1){
                foreach ($nodes as $key => $node){
                    $ip = $servers[$pod];
                    $port = $node->getConsole();

                    try {
                        $telnet = new \miyahan\network\Telnet($ip, $port);
                        $telnet->connect();
                        $result = $telnet->exec("\r\n", false);
                        if(preg_match("#^root@[a-zA-Z0-9-]+:(.*)$#", $result)){
                            print_r("   + config ".$key." : ");
                            $telnet->exec("cd /intflash\n", false);
                            $telnet->exec("rm __vm_config.yaml\n", false);
                            $telnet->exec("touch __vm_config.yaml\n", false);
                            $telnet->exec("echo \"---\" >> __vm_config.yaml\n", false);
                            $telnet->exec("echo \"system:\" >> __vm_config.yaml\n", false);
                            $telnet->exec("echo \"  license: PRD-5000-PRMR\" >> __vm_config.yaml\n", false);
                            $telnet->exec("echo \"  slots:\" >> __vm_config.yaml\n", false);
                            $telnet->exec("echo \"    - num: 1\" >> __vm_config.yaml\n", false);
                            $telnet->exec("echo \"      type: ".$config[$key]['model']."\" >> __vm_config.yaml\n", false);
                            $telnet->exec("echo \"      serial-number: ".$config[$key]['serial']."\" >> __vm_config.yaml\n", false);
                            $telnet->exec("echo \"\" >> __vm_config.yaml\n", false);
                            $telnet->exec( 'reboot');
                            unset($nodes[$key]);
                            print_r("ok\n");
                        }
                    } catch (Exception $exception){
                        echo $exception->getMessage();
                    }
                }
            } else break;
        }

        sleep(30);
        $gns3->closeProject($project);
    }
    print_r("\n");