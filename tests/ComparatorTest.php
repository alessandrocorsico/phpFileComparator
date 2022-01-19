<?php
use PHPUnit\Framework\TestCase;
use App\Comparator;

class ComparatorTest extends TestCase {    

    private $comparator;        

    public function testCompareSameFile() {

      $fileNameA = './usesCase/pdf_test_1.pdf';
      $fileNameB = './usesCase/the_same_pdf_test_1.pdf';
      $message = 'Il contenuto dei file differisce';

      $this->comparator = new Comparator($fileNameA, $fileNameB);
      
      $this->assertTrue($this->comparator->compare(), $message);

    }   
    
    public function testCompareDifferentFiles() {

      $fileNameA = './usesCase/img1.jpg';
      $fileNameB = './usesCase/img2.jpg';
      $message = 'Il contenuto dei file NON differisce oppure ALMENO UNO dei file non esiste';
      
      $this->comparator = new Comparator($fileNameA, $fileNameB);
      
      $this->assertFalse($this->comparator->compare($fileNameA, $fileNameB), $message);

    }

    public function testAssertFileEquals() {

      $fileNameA = './usesCase/pdf_test_1.pdf';
      $fileNameB = './usesCase/file3.txt';
      $message = 'I file risultano entrambi esistenti';
      
      $this->comparator = new Comparator($fileNameA, $fileNameB);
      
      $this->assertNull($this->comparator->compare($fileNameA, $fileNameB), $message);
      
    }

}