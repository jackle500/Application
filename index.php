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
    $form_validate = new FormValidation();
    $data = new Data();

    // Default route
    $f3->route('GET /',
        function () {
        $view = new Template();
        echo $view->render('views/home.html');
    });

    //Personal
    $f3->route('GET|POST /personal',
        function ($f3) use ($data, $form_validate) {
        $requiredFields = $data->getPersonalInfoFields();
        $nonRequiredFields = $data->getOptionalPersonalInfoFields();
        $form_validate->processFormData($f3, $requiredFields, $nonRequiredFields, '/experience');
        $view = new Template();
        echo $view->render('views/personal.html');
    });

    //experience
    $f3->route('GET|POST /experience', function ($f3) use ($data, $form_validate) {

        $requiredFields = $data->getExperienceFields();
        $nonRequiredFields = $data->getOptionalExperienceFields();
        $form_validate->processFormData($f3, $requiredFields, $nonRequiredFields, '/mail');

        $view = new Template();
        echo $view->render('views/experience.html');
    });

    //Mail
    $f3->route('GET|POST /mail',
        function ($f3) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selected_technologies = $_POST['tech'] ?? [];
            $selected_industries = $_POST['ind'] ?? [];
            $_SESSION['selected_technologies'] = $selected_technologies;
            $_SESSION['selected_industries'] = $selected_industries;
            $f3->set('selected_technologies', $selected_technologies);
            $f3->set('selected_industries', $selected_industries);
            $f3->reroute('/summary');
        }

        // Render the mailing-list page
        $view = new Template();
        echo $view->render('views/mail.html');
    });

                // Summary
    $f3->route('GET|POST /summary',
        function($f3) {
        foreach($_SESSION as $key => $value) {
            $f3->set($key, $value);
        }
        $view = new Template();
        echo $view->render('views/summary.html');
    });

// Run F3
    $f3->run();