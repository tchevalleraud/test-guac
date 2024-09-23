<?php
    require_once "./vendor/autoload.php";

    $projectName = "Extreme Networks - Formation SPBm";

    $gns3   = new \Tchevalleraud\GNS3\GNS3("192.168.1.50");
    $config = [
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
    ];

    $project = new \Tchevalleraud\GNS3\Project($projectName);
    $project = $gns3->searchProject($project);

    $nodes = [];
    foreach ($config as $name => $c){
        $nodes[$name] = $gns3->searchNode($project, $name);
    }

    while (true){
        if(sizeof($nodes) >= 1){
            foreach ($nodes as $key => $node){
                $ip = $gns3->searchComputes($node->getComputeId())->getHost();
                $port = $node->getConsole();

                try {
                    $telnet = new \miyahan\network\Telnet($ip, $port);
                    $telnet->connect();
                    $result = $telnet->exec("\r\n", false);
                    if(preg_match("#^Login:(.*)$#", $result)){
                        $telnet->exec( 'rwa'."\r", false);
                        sleep(1);
                        $telnet->exec( 'rwa'."\r", false);
                        sleep(1);
                    }

                    if(preg_match("#^RTR-DC(.*)#", $key)) $ports = "1/1-1/4";
                    elseif(preg_match("#^RTR-CORE(.*)#", $key)) $ports = "1/1-1/6";
                    elseif(preg_match("#^RTR-ACCESS(.*)#", $key)) $ports = "1/1-1/4";
                    else echo $key." : ERROR\n";

                    $telnet->exec( 'enable'."\r", false);
                    $telnet->exec( 'conf t'."\r", false);
                    $telnet->exec( 'vlan members remove 1 '.$ports."\r", false);
                    $telnet->exec( 'vlan create 100 name vGRAY type port-mstprstp 1'."\r", false);
                    $telnet->exec( 'vlan create 101 name vRED type port-mstprstp 1'."\r", false);
                    $telnet->exec( 'vlan create 102 name vGREEN type port-mstprstp 1'."\r", false);

                    if(preg_match("#^RTR-DC(.*)#", $key) || preg_match("#^RTR-CORE(.*)#", $key)){
                        $telnet->exec( 'interface gigabitEthernet '.$ports."\r", false);
                        $telnet->exec( 'encapsulation dot1q'."\r", false);
                        $telnet->exec( 'no shutdown'."\r", false);
                        $telnet->exec( 'vlan members add 100 '.$ports."\r", false);
                        $telnet->exec( 'vlan members add 101 '.$ports."\r", false);
                        $telnet->exec( 'vlan members add 102 '.$ports."\r", false);
                    } else {
                        $telnet->exec( 'interface gigabitEthernet 1/1-1/2'."\r", false);
                        $telnet->exec( 'encapsulation dot1q'."\r", false);
                        $telnet->exec( 'no shutdown'."\r", false);
                        $telnet->exec( 'interface gigabitEthernet 1/3-1/4'."\r", false);
                        $telnet->exec( 'no shutdown'."\r", false);
                        $telnet->exec( 'vlan members add 100 1/1-1/3'."\r", false);
                        if(preg_match("#^RTR-ACCESS(.*)-01#", $key)){
                            $telnet->exec( 'vlan members add 101 1/1-1/2,1/4'."\r", false);
                        } else {
                            $telnet->exec( 'vlan members add 102 1/1-1/2,1/4'."\r", false);
                        }
                    }
                    $telnet->exec('end'."\r", false);
                    $telnet->exec('save config'."\r", false);
                    sleep(2);
                    $telnet->exec('exit'."\r", false);
                    unset($nodes[$key]);
                } catch (Exception $exception){
                    echo $exception->getMessage();
                }
            }
        } else break;
    }

    /**
    foreach ($config as $k => $v){
        $node = $gns3->searchNode($project, $k);
        $ip = $gns3->searchComputes($node->getComputeId())->getHost();
        $port = $node->getConsole();

        try {
            $telnet = new \miyahan\network\Telnet($ip, $port);
            $telnet->connect();
            $result = $telnet->exec("\r\n", false);
            print_r($k ." => ". $result."\n");
            if(preg_match("#^Login:(.*)$#", $result)){
                $telnet->exec( 'rwa'."\r", false);
                sleep(1);
                $telnet->exec( 'rwa'."\r", false);
                sleep(1);
                $result = $telnet->exec("\r\n", false);
                print_r($k ." => ". $result."\n");
                if(preg_match("#^(.*)FabricEngine:(.*)$#", $result)) {
                    $telnet->exec( 'enable'."\r", false);
                    $telnet->exec( 'conf t'."\r", false);
                    $telnet->exec('sys name '.$k."\r", false);
                    $telnet->exec('mgmt oob'."\r", false);
                    $telnet->exec('ip address '. $v['ip'].'/24'."\r", false);
                    $telnet->exec('enable'."\r", false);
                    $telnet->exec('force-topology-ip'."\r", false);
                    $telnet->exec('end'."\r", false);
                    $telnet->exec('save config'."\r", false);
                    sleep(2);
                    $telnet->exec('exit'."\r", false);
                }
            }
            print_r("-------"."\n");
        } catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
     * */


    /**$file = fopen("./scripts/connections.csv", "w");
    fwrite($file, "Groups,Label,Tags,Hostname/IP,Protocol,Port"."\n");
    foreach ($config as $k => $v){
        fwrite($file, "Extreme Networks - Formation SPBm/POD ".$v['pod'].",".$k.",voss,".$v['ip'].",SSH,22"."\n");
    }
    fclose($file);**/