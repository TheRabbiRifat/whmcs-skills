<?php

function yourmodulename_push($params) {

    $domainid = $params['domainid'];
    $sld = $params['sld'];
    $tld = $params['tld'];

    return array(
        'templatefile' => 'pushdomain',
        'breadcrumb' => array(
            'clientarea.php?action=domaindetails&domainid='.$domainid.'&modop=custom&a=push' => 'Push Domain',
        ),
        'vars' => array(
            'var1' => 'valuehere',
            'var2' => 'anothervaluehere',
        ),
    );
}