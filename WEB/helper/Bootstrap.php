<?php
  
spl_autoload_register(function ($class) {
    // project-specific namespace prefix
    $prefix = '';
    // base directory for the namespace prefix
    $base_dir = '';
//echo 'aaaaaaaaaaaaaaaa';
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php


    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
   // echo $base_dir."<br>";
  //  echo $relative_class."<br>";
//echo $file;
    // if the file exists, require it
    if (file_exists($file)) {
       // echo 'fdg';
        require_once $file;
    }
});

