<?php

function randomString($length = 6) {
    $randomString = '';
    $characters = implode("", array_merge(range('a', 'z'), range('A', 'Z')));
    for ($i = 0; $i < $length; $i++) $randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
    return $randomString;
}
function Encode($output) { 
	$randomFunc = randomString();
    $randomOut = randomString();
    $randomNum = randomString();
    $randomVal = mt_rand(999999, 99999999);
    $return = '<script>String.prototype.decode = function(){ return decodeURIComponent(escape(this)); } ' . PHP_EOL;
    $return .= 'var ' . $randomOut . ' = ""; var ' . $randomNum . ' = [';
    foreach(str_split($output) as $x) $return .= '"'.base64_encode(randomString().(ord($x) + $randomVal)) . '", ';
    $return = rtrim($return, ', ');
    $return .= ']; ' . $randomNum . '.forEach(function ' . $randomFunc . '(value) { ' . $randomOut . ' += String.fromCharCode(parseInt(atob(value).replace(/\D/g,\'\')) - ' . $randomVal . '); } ); document.write(' . $randomOut . '.decode()); </script>'  ;;
    return $return;
}

ob_start("Encode");