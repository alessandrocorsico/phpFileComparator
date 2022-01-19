<?php
use PHPUnit\Framework\TestCase;
use App\Comparator;

class ComparatorTest extends TestCase {    

    private $comparator;    

    public function setUp() : void {
      
      $this->comparator = new Comparator;
      
    }

    public function testCompareSameFile() {

      $fileNameA = './usesCase/pdf_test_1.pdf';
      $fileNameB = './usesCase/the_same_pdf_test_1.pdf';
      $message = 'Il contenuto dei file differisce';
      
      $this->assertTrue($this->comparator->compare($fileNameA, $fileNameB), $message);

    }   
    
    public function testCompareDifferentFiles() {

      $fileNameA = './usesCase/img1.jpg';
      $fileNameB = './usesCase/img2.jpg';
      $message = 'Il contenuto dei file NON differisce oppure ALMENO UNO dei file non esiste';
      
      $this->assertFalse($this->comparator->compare($fileNameA, $fileNameB), $message);

    }

    public function testCompareInexistentFiles() {

      $fileNameA = './usesCase/pdf_test_1.pdf';
      $fileNameB = './usesCase/file3.txt';
      $message = 'I file risultano entrambi esistenti';
      
      $this->assertNull($this->comparator->compare($fileNameA, $fileNameB), $message);
      
    }

}