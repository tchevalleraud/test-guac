<?php
    require_once "./vendor/autoload.php";

    include_once "./scripts-v2/lab-variables.php";

    print_r("%%%%% Start environment %%%%%\n");
    while(true){
        print_r("*** Datacenter ***\n");
        $gns3   = new \Tchevalleraud\GNS3\GNS3($gns3dc);
        $project = new \Tchevalleraud\GNS3\Project("Scaleway - ".$projectName);
        $project = $gns3->searchProject($project);
        $project = $gns3->openProject($project);
        print_r("    + Open project on ".$gns3dc."\n");

        print_r("*** Scaleway ***\n");
        foreach ($servers as $pod => $server){
            print_r(" - Start POD ".$pod."\n");
            $gns3       = new Tchevalleraud\GNS3\GNS3($server);
            $project    = new \Tchevalleraud\GNS3\Project($projectName);
            $project    = $gns3->searchProject($project);
            $project    = $gns3->openProject($project);
            print_r("    + Open project on ".$server."\n");

            $nodes = [];
            $nodes['RTR-DC'.$pod.'-01']     = $gns3->searchNode($project, "RTR-DC".$pod."-01");
            $nodes['RTR-CORE'.$pod.'-01']   = $gns3->searchNode($project, "RTR-CORE".$pod."-01");
            $nodes['RTR-CORE'.$pod.'-02']   = $gns3->searchNode($project, "RTR-CORE".$pod."-02");
            $nodes['RTR-ACCESS'.$pod.'-01'] = $gns3->searchNode($project, "RTR-ACCESS".$pod."-01");
            $nodes['RTR-ACCESS'.$pod.'-02'] = $gns3->searchNode($project, "RTR-ACCESS".$pod."-02");
            $nodes['PC'.$pod.'11'] = $gns3->searchNode($project, 'PC'.$pod.'11');
            $nodes['PC'.$pod.'12'] = $gns3->searchNode($project, 'PC'.$pod.'12');
            $nodes['PC'.$pod.'21'] = $gns3->searchNode($project, 'PC'.$pod.'21');
            $nodes['PC'.$pod.'31'] = $gns3->searchNode($project, 'PC'.$pod.'31');

            foreach ($nodes as $key => $node){
                $gns3->startNode($project, $node);
                print_r("    + ".$node->getName()." start ".$node->getConsole()."\n");
            }
        }

        print_r("\n*** wait 60 seconds ***\n\n");
        sleep(60);
    }