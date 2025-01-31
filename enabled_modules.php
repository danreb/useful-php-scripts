<?php

/**
 * Script compatibility: Drupal ^10
 * drop and execute the file in Drupal web root, in Pantheon, it is in /code/web
 * This is very useful when you can't use any Drush command and cannot log in to your Drupal administration area.
 * For troubleshooting and debugging purposes
 * Example Usage: "php enabled_modules.php | grep pantheon" to list all modules related to Pantheon
 * Normally combined with the other script uninstall_module.php
 * As we probably know, If a certain module in Drupal is not properly uninstalled, it will produce a lot of error and sometimes a FATAL errors.
 */

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;

// Load Drupal autoloader
$autoloader = require_once __DIR__ . '/autoload.php';

// Initialize Drupal Kernel
$kernel = DrupalKernel::createFromRequest(Request::createFromGlobals(), $autoloader, 'prod');
$kernel->boot();

// Get enabled modules
$modules = \Drupal::service('module_handler')->getModuleList();
print_r(array_keys($modules));
