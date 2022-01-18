<?php

namespace App;

class Comparator {
  
  private string $fileNameA;
  private string $fileNameB;
  public string $message;

  public function setFileToCompare($fileNameA, $fileNameB) {
    $this->fileNameA = $fileNameA;
    $this->fileNameB = $fileNameB;
  }

  public function compare() {
    $fileNameA = $this->fileNameA;
    $fileNameB = $this->fileNameB;    

    clearstatcache();

    if (!file_exists($fileNameA) || !file_exists($fileNameB)) {
      $this->message = 'Uno dei file risulta inesistente';
      return false;
    }        

    if (filesize($fileNameA) != filesize($fileNameB)) {
      $this->message = 'I file differiscono per dimensione'  ;
      return false;
    }


    $chunksize = 8388608; //8mb
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