<?php

namespace App;

class Comparator {
  
  protected $fileNameA;
  protected $fileNameB;

  public function __construct($fileNameA, $fileNameB) {
    $this->fileNameA = $fileNameA;
    $this->fileNameB = $fileNameB;
  }

  public function compare() {     

    clearstatcache();

    if (!file_exists($this->fileNameA) || !file_exists($this->fileNameB)) {
      return null;
    }        

    if (filesize($this->fileNameA) != filesize($this->fileNameB)) {
      return false;
    }

    $chunksize = 3145728;//3MB, compliance to memory limit 16M
    $fp_a = fopen($this->fileNameA, 'rb'); // "b" for system which differentiate between binary and text files
    $fp_b = fopen($this->fileNameB, 'rb'); // "b" for system which differentiate between binary and text files
        
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
    }
 
    fclose($fp_a);
    fclose($fp_b);
    return true;
  }
}