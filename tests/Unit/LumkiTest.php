<?php

namespace Tests\Unit;

use Illuminate\Support\Str;
use Kineticamobile\Lumki\Lumki;
use Tests\TestCase;

// use Orchestra\Testbench\TestCase;

class LumkiTest extends TestCase
{

    public $nonExistentFilePath;
    public $filepath;

    public $backupFilePath;

    protected function setUp(): void
    {
        $this->nonExistentFilePath = __DIR__ . '/checks/nonexistingfile.txt';
        $this->filepath = __DIR__ . '/checks/file.txt';
        $this->backupFilePath = __DIR__ . '/checks/backup.txt';

        file_put_contents($this->filepath, file_get_contents($this->backupFilePath));
    }

    public function testItShouldShowMessageErrorIfNoFileExists()
    {
        $response = Lumki::insertLine($this->nonExistentFilePath, "", "");

        $this->assertEquals("The file doesn't exists!", $response);
    }

    public function testItShouldShowInfoIfLineToAddAlreadyExists()
    {
        $response = Lumki::insertLine($this->filepath, "", "2");

        $this->assertEquals("The line already exists", $response);
    }

    public function testItShouldShowInfoIfLineAddedToFileAfter()
    {
        $lineToAdd = "42";
        $addAfterLine = "2";
        $response = Lumki::insertLine($this->filepath, $addAfterLine, $lineToAdd);

        $this->assertEquals("Line Added '$lineToAdd'", $response);
        $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$addAfterLine\n$lineToAdd"));
    }

    public function testItShouldShowInfoIfLineAddedToFileBefore()
    {
        $lineToAdd = "42";
        $addBeforeLine = "2";
        $response = Lumki::insertLine($this->filepath, $addBeforeLine, $lineToAdd, false);

        $this->assertEquals("Line Added '$lineToAdd'", $response);
        $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$lineToAdd\n$addBeforeLine"));
    }

    public function testItShouldShowInfoIfLineNotAdded()
    {
        $lineToAdd = "42";
        $addAfterLine = "NonExistingString";
        $response = Lumki::insertLine($this->filepath, $addAfterLine, $lineToAdd, false);

        $this->assertEquals("Unmodified Content. '42' line not added", $response);
    }

    public function testItShouldShowInfoIfLineAddedToFileAfterWithCustomFunction()
    {
        $lineToAdd = "42";
        $addAfterLine = "2";
        $response = Lumki::insertLineAfter($this->filepath, $addAfterLine, $lineToAdd);

        $this->assertEquals("Line Added '$lineToAdd'", $response);
        $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$addAfterLine\n$lineToAdd"));
    }

    public function testItShouldShowInfoIfLineAddedToFileBeforeWithCustomFunction()
    {
        $lineToAdd = "42";
        $addBeforeLine = "2";
        $response = Lumki::insertLineBefore($this->filepath, $addBeforeLine, $lineToAdd);

        $this->assertEquals("Line Added '$lineToAdd'", $response);
        $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$lineToAdd\n$addBeforeLine"));
    }
}
