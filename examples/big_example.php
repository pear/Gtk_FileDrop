<?php
/**
*   Bigger test application for Gtk_FileDrop class
*   Uses different MIME Types and file extensions
*   as well as callbacks with objects
*
*   @author Christian Weiske <cweiske@cweiske.de>
*/
if (!extension_loaded('gtk')) {	
    dl('php_gtk.' . PHP_SHLIB_SUFFIX);
}
require_once('Gtk/FileDrop.php');

class Test 
{
    var $te = 'asd';
    function Test() {
        $this->te = time();
    }
    function try($widget, $arFiles)
    {
        echo $this->te . ' test';
        var_dump(get_class($widget), $arFiles);
    }
}

$window = &new GtkWindow();
$window->set_default_size(300, 300);
$window->connect_object('destroy', array('gtk', 'main_quit'));
$window->show();

$table =& new GtkTable();
$window->add($table);
$arTypes = array(
    array('inode/directory'),
    array('.txt', '.htm', '.html'),
    array('image/*'),
    array('image/png'),
    array('.scott')
);

$nCount = 0;
foreach ($arTypes as $arTypeList) {
    $label =& new GtkLabel(implode( ';', $arTypeList));
    $table->attach($label, 0, 1, $nCount, $nCount + 1, GTK_FILL, GTK_FILL);
    
    $entry =& new GtkButton('drop on me');
    $table->attach($entry, 1, 2, $nCount, $nCount + 1, GTK_EXPAND | GTK_FILL, GTK_FILL);
    
    Gtk_FileDrop::attach($entry, $arTypeList);
    
    $nCount++;
}

$list =& new GtkList();
$table->attach($list, 0, 3, $nCount, $nCount + 1, GTK_EXPAND | GTK_FILL, GTK_EXPAND | GTK_FILL);
Gtk_FileDrop::attach($list, array( 'text/*'));
$nCount++;

$fs =& new GtkFileSelection('select a php file');
Gtk_FileDrop::attach($fs, array( 'text/php', '.php', 'inode/directory'));
$fs->show();

$cmb =& new GtkCombo();
$table->attach($cmb, 0, 3, $nCount, $nCount + 1, GTK_FILL, GTK_FILL);
$test = new Test();
Gtk_FileDrop::attach($cmb, array( 'text/plain'), array( &$test, 'try'), false);

$test->te = 'asd';
$window->show_all();
gtk::main();
?>