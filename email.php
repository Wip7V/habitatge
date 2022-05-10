<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title></title>


</head>

<body>

<?php
/* connect to gmail */
//configurar antes la cuenta gmail
//https://www.google.com/settings/security/lesssecureapps
//https://accounts.google.com/b/0/DisplayUnlockCaptcha

set_time_limit(4000);
 
// Connect to gmail
$imapPath = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'wipr7@hotmail.com';
$password = 'e09876543';
 
// try to connect
$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to email: ' . imap_last_error());
 
 
// search and get unseen emails, function will return email ids
imap_sort($inbox, SORTARRIVAL, 0);
$emails = imap_search($inbox,'ALL');
 
$output = '';
$cont = 0;
 
foreach($emails as $mail) {
    
    $headerInfo = imap_headerinfo($inbox,$mail);
    $overview = imap_fetch_overview($inbox,$mail,0);
    
    /*$output .= '<b>from:</b>'. $overview[0]->from.'<br/>';
    $output .= '<b>subject:</b>'. $headerInfo->subject.'<br/> ';
    $output .= '<b>toaddress:</b>'. $headerInfo->toaddress.'<br/>';
    $output .= '<b>date:</b>'.$headerInfo->date.'<br/>';
    $output .= '<b>fromaddress:</b>'.$headerInfo->fromaddress.'<br/>';
    $output .= '<b>reply_toaddress:</b>'.$headerInfo->reply_toaddress.'<br/>';*/
    echo "<pre>";
    var_dump($headerInfo);
    echo "</pre>";
    
    //$emailStructure = imap_fetchstructure($inbox,$mail,2);
    
    /*if(!isset($emailStructure->parts)) {
         $output .= imap_body($inbox, $mail, FT_PEEK);
    } else {
        //    
    }*/
    $message = imap_fetchbody($inbox,$mail,2);
   $output.= '<div class="message" id="msg_'.$cont.'"><textarea>'.$message.'</textarea></div>';
   echo $output;
   echo "<hr>";
   $output = '';
   
   if($cont>10) break;
   $cont++;
}
 
// colse the connection
imap_expunge($inbox);
imap_close($inbox);
//- See more at: https://arjunphp.com/reading-emails-from-gmail-using-php-imap/#sthash.Jshc61TB.dpuf

?>
</body>
</html>