<?php 
if ($GLOBALS['is_my_file_browser_YES'] == true) {
function getClientIP() {
        if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) {
            return  $_SERVER["HTTP_CF_CONNECTING_IP"];
        }else if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            return  $_SERVER["HTTP_X_FORWARDED_FOR"];
        }else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            return $_SERVER['REMOTE_ADDR'];
        }else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        return '';
    };
function is_whitelisted($clientIp) {
    return in_array($clientIp, $GLOBALS['ip_whitelist'])==true;
}
function log_ip() { 

    $ip_whitelist = $GLOBALS['ip_whitelist'];
    $clientIp = getClientIP();

    $ipline = '';
    if (!is_writable('$BASIC_IP_LOG_FILE$')) {
    echo 'hell';
    }
    $ipf = fopen('$BASIC_IP_LOG_FILE$', 'a+');
    $cursor = -1;
    fseek($ipf, $cursor, SEEK_END);
    $char = fgetc($ipf);
    /**
     * Trim trailing newline chars of the file
     */
    while ($char === "\n" || $char === "\r") {
        fseek($ipf, $cursor--, SEEK_END);
        $char = fgetc($ipf);
    }
    /**
     * Read until the start of file or first newline char
     */
    while ($char !== false && $char !== "\n" && $char !== "\r") {
        /**
         * Prepend the new char
         */
        $ipline = $char . $ipline;
        fseek($ipf, $cursor--, SEEK_END);
        $char = fgetc($ipf);
    }

    if (!is_whitelisted(getClientIP()) && !is_whitelisted($ipline) && $ipline !== $clientIp) { 
        fwrite($ipf, $clientIp . "\n");
        
    } else if (in_array($ipline, $ip_whitelist)==true) {
        $ipline = 'Whitelisted';
    }
    fclose($ipf);

    return $ipline;
}
function log_activity($activity,$user,$files,$extra) {
    echo("LOGGED");
    if (is_writable('$EVENT_LOG_FILE$')) {
        $log_fd = fopen('$EVENT_LOG_FILE$', 'a+');
        if (!is_whitelisted(getClientIP())) {
            fwrite($log_fd, $activity.'|'.$user.'|'.getClientIP() .'|'. date("Y-m-d H:i:s").'|'.implode(',',$files).'|'.$extra."\n");
        }
        fclose($log_fd);
    } else {
        echo 'Cannot write to logfile.';
    }
}


// Allows the website to show recently uploaded files 
// This is much easier than running a database
function appendEntryToRecents($text) {
    $n = 6-1;

    $file = '$RECENTS_FILE$';
    $lines = file($file);

    $keepLines = array_slice($lines,0,$n);

    if (!in_array($file,$keepLines)) {

        $fd = fopen($file,'w');

        fwrite($fd,$text."\n");
        foreach ($keepLines as $line) {
            fwrite($fd,$line);
        }



        fclose($fd);
    }
}

function getRecents() {
    $file = '$RECENTS_FILE$';
    return array_map(function ($x) {return trim($x);}, file($file));
}

function removeEntryFromRecents($text) {
    $file = '$RECENTS_FILE$';
    $lines = file($file);
    $fd = fopen($file,'w');

    foreach ($keepLines as $line) {
        if (trim($line)!=$text) {
        fwrite($fd,$line);
        }
    }
    fclose($fd);
}


}

else {
    ?><h1>Access forbidden.</h1> <?php
    
}


?>
