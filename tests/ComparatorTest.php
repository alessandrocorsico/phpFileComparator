<?php
use PHPUnit\Framework\TestCase;
use App\Comparator;

class ComparatorTest extends TestCase {    

    private $comparator;

    private $fileNameA = './usesCase/file1.txt';
    private $fileNameB = './usesCase/file2.txt';

    public function setUp() : void {
      
      $this->comparator = new Comparator;
      
    }

    public function testCompare() {

      $this->comparator->setFileToCompare($this->fileNameA, $this->fileNameB);

      $this->assertEquals(true, $this->comparator->compare(), $this->comparator->message);
    }

    public function testAssertFileEquals() {

      $this->assertFileEquals($this->fileNameA, $this->fileNameB, 'Il contenuto dei file differisce');

    }

}