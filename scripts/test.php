<?php
    require_once "./vendor/autoload.php";

    $projectName = "Extreme Networks - Test";

    $gns3   = new \Tchevalleraud\GNS3\GNS3("192.168.1.50");

    $cloud  = $gns3->searchTemplate("Cloud");

    $project = new \Tchevalleraud\GNS3\Project($projectName);
    $project->setShowGrid(false);
    $gns3->deleteProject($project);
    $gns3->createProject($project);

    /**
     * NODES
     */
    $MGMT_RTR_DC1_01     = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_DC1_01', 'x' => -500, 'y' => -200]);
    $MGMT_RTR_CORE1_01     = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_CORE1_01', 'x' => -300, 'y' => -200]);
    $MGMT_RTR_CORE1_02     = $gns3->createTemplateNode($project, $cloud, ['compute_id' => $gns3->getComputes(0)->getComputeId(), 'name' => 'MGMT_RTR_CORE1_02', 'x' => -100, 'y' => -200]);