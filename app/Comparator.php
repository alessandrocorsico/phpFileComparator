<?php

namespace App;

class Comparator {
  
  private string $fileNameA;
  private string $fileNameB;
  public string $message;

  protected $fileNameA;
  protected $fileNameB;

  public function __construct($fileNameA, $fileNameB) {
    $this->fileNameA = $fileNameA;
    $this->fileNameB = $fileNameB;
  }
  
  public function compare() {

  public function compare() {
    $fileNameA = $this->fileNameA;
    $fileNameB = $this->fileNameB;    

    clearstatcache();

    if (!file_exists($this->fileNameA) || !file_exists($this->fileNameB)) {
      return null;
    }        

    if (filesize($this->fileNameA) != filesize($this->fileNameB)) {
      return false;
    }

    $chunksize = 4096;//3MB, compliance to memory limit 16M
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
            $this->message = 'Il contenuto dei file differisce';
            return false;
        }
    }
 
    fclose($fp_a);
    fclose($fp_b);
    $this->message = 'Il contenuto dei file è uguale';
    return true;
  }
}