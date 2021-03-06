<?php

require 'includes/graphs/common.inc.php';

$rrd_filename = rrd_name($device['hostname'], array('app', 'mysql', $app['app_id']));

$array = array(
          'IBSRs' => 'Spin Rounds',
          'IBSWs' => 'Spin Waits',
          'IBOWs' => 'OS Waits',
         );

$i = 0;
if (rrdtool_check_rrd_exists($rrd_filename)) {
    foreach ($array as $ds => $var) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        if (is_array($var)) {
            $rrd_list[$i]['descr'] = $var['descr'];
        } else {
            $rrd_list[$i]['descr'] = $var;
        }

        $rrd_list[$i]['ds'] = $ds;
        $i++;
    }
} else {
    echo "file missing: $file";
}

$colours   = 'mixed';
$nototal   = 1;
$unit_text = 'Semaphores';

require 'includes/graphs/generic_multi_simplex_seperated.inc.php';
