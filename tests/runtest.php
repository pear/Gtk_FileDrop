<?php
/**
*   runs the PHPUnit tests for Gtk_FileDrop
*   and outputs the results
*
*   @author Christian Weiske <cweiske@cweiske.de>
*/

require_once 'FileDrop_testcase.php';
require_once 'PHPUnit.php';

$suite  = new PHPUnit_TestSuite( "Gtk_FileDrop_Test");
$result = PHPUnit::run( $suite);
echo $result -> toString();
?>