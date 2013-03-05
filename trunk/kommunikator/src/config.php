<?php

/* File created by FreeSentral v1.2 */

date_default_timezone_set("Europe/London");
//date_default_timezone_set("Europe/Moscow");

require_once("DB.php");

function handle_pear_error($e) {
    Yate::Output($e->getMessage() . ' ' . print_r($e->getUserInfo(), true));
}

require_once 'PEAR.php';
//PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'handle_pear_error');

$db_type_sql = "mysql";
$db_host = "localhost";
$db_user = "user";
$db_passwd = "user";
$db_database = "PBX";

$dsn = "$db_type_sql://$db_user:$db_passwd@$db_host/$db_database";
$conn = DB::connect($dsn);
$debug_info = true;

if (PEAR::isError($conn)) {
    if ($debug_info)
        echo 'DBMS/Debug Message: ' . $conn->getDebugInfo() . "<br>";
    else
        echo 'Standard Message: ' . $conn->getMessage() . "<br>";
    exit;
}

$conn->setFetchMode(DB_FETCHMODE_ASSOC);

$vm_base = "/var/lib/misc";
$no_groups = false;
$no_pbx = false;
$uploaded_prompts = "/var/lib/misc";
$query_on = false;
$max_resets_conn = 5;

//$calls_email  = "root@localhost";
//$fax_call = "root@localhost";

$calls_email = "info@digt.ru";
$fax_call = "info@digt.ru";

$source = array(
    'voicemail' => 'external/nodata/voicemail.php',
    'attendant' => 'external/nodata/auto_attendant.php'
);

$key_source = array();
foreach ($source as $key => $value)
    $key_source[$value] = $key;

$time_out = 600;
?>