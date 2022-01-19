<?php

namespace App;

class Comparator {

  public function __construct() {
    //
  }
 
  public function compare(string $fileNameA, string $fileNameB) {

    clearstatcache();

    if (!file_exists($fileNameA) || !file_exists($fileNameB)) {
      return null;
    }        

    if (filesize($fileNameA) != filesize($fileNameB)) {
      return false;
    }

    $chunksize = 3145728;//2097152;//2MB, compliance to memory limit 16M
    $fp_a = fopen($fileNameA, 'rb'); // "b" for system which differentiate between binary and text files
    $fp_b = fopen($fileNameB, 'rb'); // "b" for system which differentiate between binary and text files
        
    while (!feof($fp_a) && !feof($fp_b))
    {
        $d_a = fread($fp_a, $chunksize);
        
        $d_b = fread($fp_b, $chunksize);
        
        if ($d_a === false || $d_b === false || $d_a !== $d_b)
        {
            fclose($fp_a);
            fclose($fp_b);
            return false;
        }
        /* yield $d_a;
        yield $d_b; */
    }
 
    fclose($fp_a);
    fclose($fp_b);
    return true;
  }
}