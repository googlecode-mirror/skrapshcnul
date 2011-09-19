<?php

/*
 * @author Tien
 * For debugging purpose, we wish to print out diagnostic messages into a log 
 * file.
 * Note: Disable when running on actual server.
 */

class Logger {
  
  const _ENABLE = TRUE;
  const _LOGFILE = '/tmp/log.txt';    
  
  function log($data) {
    if (self::_ENABLE) {
      $fh = fopen(self::_LOGFILE, 'a') or fopen(self::_LOGFILE, 'w') or die("Can't open file");    
      
      ob_start();
      print_r(time());
      print_r("\n");
      print_r($data);
      print_r("\n");
      $output = ob_get_clean();
      fwrite($fh, $output);    
      fclose($fh);
    }
  }
}

?>
