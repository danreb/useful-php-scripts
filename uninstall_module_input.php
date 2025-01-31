<?php

/**
 *
 * @file
 * Script to uninstall a module, useful if you can't use the Drush command to uninstall a module
 * Drop and execute the file inside Drupal root, in Pantheon, it is in /code/web
 * This accepts input for module name $module_name
 * USAGE: "php install_module.php search_api_pantheon" - to uninstall Search API Pantheon, use the module machine name
 */

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

// Load the Drupal autoloader
$autoloader = require_once __DIR__ . '/autoload.php';

// Initialize Drupal Kernel
$kernel = DrupalKernel::createFromRequest(Request::createFromGlobals(), $autoloader, 'prod');
$kernel->boot();

// Check if a module name was provided via command-line arguments
if ($argc < 2) {
    echo "Usage: php install_module.php <module_name>\n";
    exit(1); // Exit if no module name is provided
}

$module_name = $argv[1]; // Get the module name from the command-line argument

// Initialize the module installer
if (\Drupal::moduleHandler()->moduleExists($module_name)) {
    // Uninstall the module
    \Drupal::service('module_installer')->uninstall([$module_name]);
    echo "Module '$module_name' has been uninstalled.\n";
} else {
    echo "Module '$module_name' is not installed or does not exist.\n";
}
