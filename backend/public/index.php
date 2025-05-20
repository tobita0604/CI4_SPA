<?php

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Location of the Paths config file
// This is the line that might need to be changed, depending on your folder structure.
$pathsPath = FCPATH . '../app/Config/Paths.php';

// ^^^ Change this if you move your application folder

require realpath($pathsPath) ?: $pathsPath;

$paths = new Config\Paths();

// Location of the framework bootstrap file.
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app       = require realpath($bootstrap) ?: $bootstrap;

// Launch the application
$app->run();