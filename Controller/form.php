<?php
    /*
     * Huy Le
     * Job Application Version 3
     * form.php
     * This file handles the validation of information from personal, experience, and mail HTML forms.
     */
    class FormValidation {

        public function processFormData(object $f3, array $requiredFields, array $nonRequiredFields, string $redirect): void {
            $this->initializeErrorMessages($f3, $requiredFields);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $formValid = $this->processRequiredFields($f3, $requiredFields);
                $this->processNonRequiredFields($f3, $nonRequiredFields);

                if ($formValid) {
                    $f3->reroute($redirect);
                }
            }
        }

        private function initializeErrorMessages(object $f3, array $requiredFields): void {

            // Initialize each error variable with empty string
            foreach ($requiredFields as $field) {
                $f3->set("{$field}_error", '');
            }
        }


        private function processRequiredFields(object $f3, array $requiredFields): bool {
            $formIsValid = true;
            foreach ($requiredFields as $field) {
                $value = $_POST[$field] ?? '';
                $fieldIsValid = $this->validateField($f3, $field, $value);
                if (!$fieldIsValid) {
                    $formIsValid = false;
                } else {
                    if($field == 'first_name' || $field == 'last_name'){
                        $_SESSION[$field] = ucwords(strtolower($value));
                    } else {
                        $_SESSION[$field] = $value;
                    }
                }
            }
            return $formIsValid;
        }


        private function processNonRequiredFields(object $f3, array $nonRequiredFields): void {
            foreach ($nonRequiredFields as $field) {
                $value = $_POST[$field] ?? '';
                if($field == 'github' && $value != '') {
                    if (Validate::validGithub($value)) {
                        $_SESSION[$field] = $value;
                    } else {
                        $f3->set("{$field}_error", 'Invalid Github link provided');
                    }
                    // relocation
                } else if($field == 'relocate' && $value != '') {
                    $_SESSION[$field] = ucfirst($value);
                    // bio
                } else if($field == 'bio' && $value != '') {
                    $_SESSION[$field] = $value;
                    // state
                } else if ($field == 'state' && isset($_POST['state'])) {
                    $selected_state = $_POST['state'];
                    $_SESSION[$field] = $selected_state;
                }
            }
        }
        private function validateField(object $f3, string $field, string $value): bool {
            $isValid = true;
            if ($field == 'first_name' || $field == 'last_name') {
                if (!Validate::validName($value)) {
                    $isValid = false;
                    $f3->set("{$field}_error", "Valid {$field} is required");
                }
            } else if ($field == 'email') {
                if (!Validate::validEmail($value)) {
                    $isValid = false;
                    $f3->set("{$field}_error", "Valid {$field} is required");
                }
            } else if ($field == 'phone') {
                if (!Validate::validPhone($value)) {
                    $isValid = false;
                    $f3->set("{$field}_error", "Valid {$field} is required");
                }
            } else if ($field == 'experience') {
                if (!Validate::validExperience($value)) {
                    $isValid = false;
                    $f3->set("{$field}_error", "Valid {$field} is required");
                }
            }

            return $isValid;
        }

    }