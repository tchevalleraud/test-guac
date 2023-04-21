<?php
    $ip     = "192.168.1.51";
    $port   = 5000;

    $telnet = fsockopen($ip, $port);
    while (true){
        fwrite($telnet, "\r\n");

        $response   = fgets($telnet);

        if(preg_match("#^root@[a-zA-Z0-9-]+:(.*)$#", $response)){
            echo "__vm_config.yaml";
            fwrite($telnet, 'cd /intflash'."\r");
            fwrite($telnet, 'touch __vm_config.yaml'."\r");
            fwrite($telnet, 'echo "---" >> __vm_config.yaml'."\r");
            fwrite($telnet, 'echo "system:" >> __vm_config.yaml'."\r");
            fwrite($telnet, 'echo "  license: PRD-5000-PRMR,PRD-5000-MACSEC" >> __vm_config.yaml'."\r");
            fwrite($telnet, 'echo "  slots:" >> __vm_config.yaml'."\r");
            fwrite($telnet, 'echo "    - num: 1" >> __vm_config.yaml'."\r");
            fwrite($telnet, 'echo "      type: 5520-24X" >> __vm_config.yaml'."\r");
            fwrite($telnet, 'echo "      serial-number: 00000-00000" >> __vm_config.yaml'."\r");
            sleep(1);
            break;
        } else {
            sleep(5);
        }
    }
    fclose($telnet);