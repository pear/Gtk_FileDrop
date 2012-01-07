<?php
/**
*   PHPUnit tests for the Gtk_FileDrop class
*
*   @author Christian Weiske <cweiske@cweiske.de>
*/

require_once 'Gtk/FileDrop.php';
require_once 'PHPUnit/Framework/TestCase.php';

class Gtk_FileDrop_Test extends PHPUnit_Framework_TestCase
{
    function testUriList() {
        $arTests = array(
            'file://localhost/path/to/file' => '/path/to/file',
            'file://host/path/to/file'      => '/host/path/to/file',
            'file:/path/to/file2'           => '/path/to/file2',
            'file:///path/to/file3'         => '/path/to/file3',
            'file://path/to/file4'          => '/path/to/file4',
            'file:/path/to/file5'           => '/path/to/file5',
            //relative? | shouldn't be used, but who knows...
            'file:path/to/file6'            => 'path/to/file6',
            //windows
            'file:///c:/path/to/file'       => 'c:\path\to\file' 
        );
        
        foreach( $arTests as $strUri => $strExpected) {
            $this->assertEquals( $strExpected, Gtk_FileDrop::getPathFromUrilistEntry( $strUri));
        }
    }
    
    
    function testFileExtension() {
        $arTests = array(
            '/data/file.txt'        => '.txt',
            'file.txt'              => '.txt',
            '/data.txt/file'        => '',
            '/data/file'            => ''
        );
        foreach( $arTests as $strFile => $strExpected) {
            $this->assertEquals( $strExpected, Gtk_FileDrop::getFileExtension( $strFile));
        }
        
    }
}
