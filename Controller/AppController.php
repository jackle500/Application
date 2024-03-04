<?php

    /**
     * Class AppController
     *
     * This class handles the routing and logic for the application.
     */
    class AppController
    {
        private Data $data;
        private FormControl $formValidate;

        public function __construct(Data $data, FormControl $formValidate)
        {
            $this->data = $data;
            $this->formValidate = $formValidate;
        }

        public function home(): void
        {
            // Render the homepage
            $view = new Template();
            echo $view->render('views/home.html');
        }

        public function personal(Base $f3): void
        {
            $requiredFields = $this->data->getPersonalInfoFields();
            $nonRequiredFields = $this->data->getOptionalPersonalInfoFields();
            $this->formValidate->processFormData($f3, $requiredFields, $nonRequiredFields, '/experience');
            $view = new Template();
            echo $view->render('views/personal.html');
        }

        public function experience(Base $f3): void
        {
            $requiredFields = $this->data->getExperienceFields();
            $nonRequiredFields = $this->data->getOptionalExperienceFields();
            $this->formValidate->processFormData($f3, $requiredFields, $nonRequiredFields, '/mail');
            $view = new Template();
            echo $view->render('views/experience.html');
        }

        public function mail(Base $f3): void
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $selectedTechnologies = $_POST['tech'] ?? [];
                $selectedIndustries = $_POST['ind'] ?? [];
                $_SESSION['selected_technologies'] = $selectedTechnologies;
                $_SESSION['selected_industries'] = $selectedIndustries;
                $f3->set('selected_technologies', $selectedTechnologies);
                $f3->set('selected_industries', $selectedIndustries);
                $f3->reroute('/summary');
            }

            // Render the mailing-list page
            $view = new Template();
            echo $view->render('views/mail.html');
        }

        public function summary(Base $f3): void
        {
            foreach ($_SESSION as $key => $value) {
                $f3->set($key, $value);
            }
            // Render the summary page
            $view = new Template();
            echo $view->render('views/summary.html');
        }
    }
