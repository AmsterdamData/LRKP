<?php
header("Content-Type: text/csv");
header('Content-Disposition: inline; filename="lrkp-'. date("YmdHis") .'.csv"');

    $result = null;
    $lines = file('http://www.landelijkregisterkinderopvang.nl/opendata/export_opendata_lrkp.csv');
    $out = fopen('php://output', 'w');
    $maxcolumns = 0;
    foreach($lines as $line){
        $record = str_getcsv($line, ";");
        if(count($record) > $maxcolumns) $maxcolumns = count($record);
        $count++;
        $plaats = trim(strtolower($record[10]));
        if($plaats == "opvanglocatie_woonplaats" || $plaats == "amsterdam" || $plaats == "amsterdam zuidoost"){
            while(count($record) < $maxcolumns) $record[] = "";
            fputcsv($out, $record,";","\"");            
            //$result .= $line;
        }
    }
    
//header('Content-Disposition: inline');
//header("Content-Length: " . strlen($result));    
//echo($result);
?>