<?php
function euclidean($lat, $long, $depth, $str, $dn, $lat2, $long2, $depth2, $str2, $dn2)
{
    $euclidean = sqrt(pow(abs($lat - $lat2), 2) + pow(abs($long - $long2), 2) + pow(abs($depth - $depth2), 2) + pow(abs($str - $str2), 2) + pow(abs($dn - $dn2), 2));
    return $euclidean;
}
