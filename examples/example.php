<?php
/**
*   Test application for the Gtk_FileDrop class
*   @author Christian Weiske <cweiske@cweiske.de>
*/
if (!extension_loaded('gtk')) {	
    dl('php_gtk.' . PHP_SHLIB_SUFFIX);
}
require_once('Gtk/FileDrop.php');

$window = &new GtkWindow();
$window->set_default_size(300, 30);
$window->connect_object('destroy', array('gtk', 'main_quit'));
$window->show();

$entry =& new GtkEntry();
$window->add($entry);
$entry->set_text('drop text files on me');
Gtk_FileDrop::attach($entry, array('text/plain'));
    
$window->show_all();
gtk::main();
?>