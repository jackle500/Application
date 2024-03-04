<?php
    /*
     * Huy Le
     * Joo Application Version 3
     * index.php
     * This file defines routes and logic for a multi-step application using the Fat-Free Framework.
     */

//Turn on error reporting and start the session
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();

    require_once('vendor/autoload.php');
    require_once 'model/validate.php';


// Instantiate Fat-Free framework (F3)
    $f3 = Base::instance();
    $form_validate = new FormControl();
    $data = new Data();
    $controller  = new AppController($data,$form_validate);

    // Route to home
    $f3->route('GET /', function () {
        $GLOBALS['controller']->home();
    });

    //Personal
    $f3->route('GET|POST /personal',
        function ($f3) use ($data, $form_validate) {
            $GLOBALS['controller']->personal($f3);
    });

    //experience
    $f3->route('GET|POST /experience', function ($f3) use ($data, $form_validate) {
        $GLOBALS['controller']->experience($f3);
    });

    //Mail
    $f3->route('GET|POST /mail',
        function ($f3) {
            $GLOBALS['controller']->mail($f3);
        });

                // Summary
    $f3->route('GET|POST /summary',
        function($f3) {
            $GLOBALS['controller']->summary($f3);
        });

    $f3->run();