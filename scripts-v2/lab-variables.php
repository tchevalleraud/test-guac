<?php
    $projectName    = "Extreme Networks - Deepdive SPBm";

    // Instance GP1-M (3 by Zone)(16 vCore / 64GO RAM / 1,5Gps) (+60Go Disk)
    $servers        = [
        1   => "51.158.165.88",
        2   => "51.158.162.241",
        3   => "51.158.184.86",
        4   => "51.158.238.55",
        5   => "51.158.238.59",
        6   => "51.158.238.7",
    ];

    $config = [
        'RTR-DC1-01'        => ['model' => '5520-24X', 'serial' => '05520-01001'],
        'RTR-CORE1-01'      => ['model' => '5520-24X', 'serial' => '05520-01002'],
        'RTR-CORE1-02'      => ['model' => '5520-24X', 'serial' => '05520-01003'],
        'RTR-ACCESS1-01'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-01004'],
        'RTR-ACCESS1-02'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-01005'],
        'RTR-DC2-01'        => ['model' => '5520-24X', 'serial' => '05520-02001'],
        'RTR-CORE2-01'      => ['model' => '5520-24X', 'serial' => '05520-02002'],
        'RTR-CORE2-02'      => ['model' => '5520-24X', 'serial' => '05520-02003'],
        'RTR-ACCESS2-01'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-02004'],
        'RTR-ACCESS2-02'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-02005'],
        'RTR-DC3-01'        => ['model' => '5520-24X', 'serial' => '05520-03001'],
        'RTR-CORE3-01'      => ['model' => '5520-24X', 'serial' => '05520-03002'],
        'RTR-CORE3-02'      => ['model' => '5520-24X', 'serial' => '05520-03003'],
        'RTR-ACCESS3-01'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-03004'],
        'RTR-ACCESS3-02'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-03005'],
        'RTR-DC4-01'        => ['model' => '5520-24X', 'serial' => '05520-04001'],
        'RTR-CORE4-01'      => ['model' => '5520-24X', 'serial' => '05520-04002'],
        'RTR-CORE4-02'      => ['model' => '5520-24X', 'serial' => '05520-04003'],
        'RTR-ACCESS4-01'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-04004'],
        'RTR-ACCESS4-02'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-04005'],
        'RTR-DC5-01'        => ['model' => '5520-24X', 'serial' => '05520-05001'],
        'RTR-CORE5-01'      => ['model' => '5520-24X', 'serial' => '05520-05002'],
        'RTR-CORE5-02'      => ['model' => '5520-24X', 'serial' => '05520-05003'],
        'RTR-ACCESS5-01'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-05004'],
        'RTR-ACCESS5-02'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-05005'],
        'RTR-DC6-01'        => ['model' => '5520-24X', 'serial' => '05520-06001'],
        'RTR-CORE6-01'      => ['model' => '5520-24X', 'serial' => '05520-06002'],
        'RTR-CORE6-02'      => ['model' => '5520-24X', 'serial' => '05520-06003'],
        'RTR-ACCESS6-01'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-06004'],
        'RTR-ACCESS6-02'    => ['model' => '5420M-24W-4YE', 'serial' => '05520-06005'],
    ];
    $datacenter = "109.222.4.185";
    $gns3dc = "10.201.100.121";
    $waitFactor = 1;