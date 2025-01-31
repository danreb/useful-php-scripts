<?php

/**
 *
 * @file
 * Script to uninstall a module, useful if you can't use Drush command to uninstall a module
 * In this script, I am removing the "Search API Pantheon" module, see $module_name
 * Please edit this file, don't just run it blindly
 * Usage "php uninstall_module.php"
 * Drop and execute the file inside Drupal root, in Pantheon, it is in /code/web
 */

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

// Load the Drupal autoloader
$autoloader = require_once __DIR__ . '/autoload.php';

// Initialize Drupal Kernel
$kernel = DrupalKernel::createFromRequest(Request::createFromGlobals(), $autoloader, 'prod');
$kernel->boot();

// Initialize the module installer
$module_name = 'search_api_pantheon';

if (\Drupal::moduleHandler()->moduleExists($module_name)) {
    // Uninstall the module
    \Drupal::service('module_installer')->uninstall([$module_name]);
    echo "Module '$module_name' has been uninstalled.\n";
} else {
    echo "Module '$module_name' is not installed.\n";
}
