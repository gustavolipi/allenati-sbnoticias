<?php
$dbname = 'u808793019_sbnoticias';
$dbuser = 'u808793019_sbnoticias';
$dbpass = 'XvDug2fsn5';
$dbhost = 'srv1182.hstgr.io';

$connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($dbname) or die("Could not open the db '$dbname'");

$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($test_query);

$tblCnt = 0;
while ($tbl = mysqli_fetch_array($result)) {
    $tblCnt++;
    #echo $tbl[0]."<br />\n";
}

if (!$tblCnt) {
    echo "There are no tables<br />\n";
} else {
    echo "There are $tblCnt tables<br />\n";
}
