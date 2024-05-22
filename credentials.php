<?php 
    if ($GLOBALS['CANARY_TOKEN'] == true) {
    // User:hash pairs 
    $auth_users = array(
        // admin:admin
        'admin' => '$2y$10$.jacIgYkMGuyimTFW8BlBu/o.mVtDYPEuM.1Pdw7NKy0uNyTq8/qC'
    );
    
    // Readonly users
    // e.g. array('users', 'guest', ...)
    $readonly_users = array(
        'user',
        'admin'
    );
    
    // Has access to deletion of files
    $admin_users = array(
        'admin'
    );
    // IP-addresses, both ipv4 and ipv6
    $ip_whitelist = array(
        '127.0.0.1',    // local ipv4
        '::1',           // local ipv6
    );
    $GLOBALS['ip_whitelist'] = $ip_whitelist;

    // IP-addresses, both ipv4 and ipv6
    $ip_blacklist = array(
        '0.0.0.0',      // non-routable meta ipv4
        '::'            // non-routable meta ipv6
    );

    // Root path for file manager
    // use absolute path of directory i.e: '/var/www/folder' or $_SERVER['DOCUMENT_ROOT'].'/folder'
    $root_path = "/var/www/secret";


    // Name to show in the title of the website    
    $APP_NAME = "Public Drive";
    
    // Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
    // Will not working if $root_path will be outside of server document root
    $root_url = 'index.php?p=';

    } else {
        ?><b>Access denied.</b> <?php
        throw Exception('Access denied.');
    }

?>
