<?php
require_once('virustotal.class.php');
$vt = new virustotal($apikey);
$res = $vt->checkFile($filename,$hash); // $hash is optional. Pass the $scan_id if you have it, or the file hash
switch($res) {
  case -99: // API limit exceeded
    // deal with it here – best by waiting a little before trying again :)
    break;
  case  -1: // an error occured
    // deal with it here
    break;
  case   0: // no results (yet) – but the file is already enqueued at VirusTotal
    $scan_id = $vt->getScanId();
    $json_response = $vt->getResponse();
    break;
  case   1: // results are available
    $json_response = $vt->getResponse();
    break;
  default : // you should not reach this point if you've placed the break before :)
}
// deal with the JSON response here
