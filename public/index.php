<?php

// Open session
session_start();

// Load config
require_once('../config.php');

// Load all project classes
require_once('../vendor/autoload.php');

// Load the routes system
require_once('../core/routes.php');
