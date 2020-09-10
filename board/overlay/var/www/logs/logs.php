<?php
#session_start();
#if (!isset($_SESSION['email_address']))
#{
#    	// User is not logged in, so send user away.
#    	header("Location:login.html");
#    	die();
#}
// User is logged in; private code goes here.
  $thelist =''; 
  if ($handle = opendir('logs'))
  {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != "..") {
        $thelist .= '<li><a href="./logs/'.$file.'">'.$file.'</a></li>';
      }
    }
    closedir($handle);
  } 
  else{
	$thelist.= 'Could not Find Logs';
  }
?>
<h1>List of files:</h1>
<ul><?php echo $thelist; ?></ul>
