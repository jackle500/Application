<?php

        /*
    * Huy Le
    * Job Application Version 3
    * validate.php
    * This file validate all the storing information from personal, experience
    * */
    class Validate {
        public static function validName(string $name): bool {
            return ctype_alpha($name);
        }

        public static function validGithub(string $gitHubLink): bool {
            return preg_match("/^(https?:\/\/)?(www\.)?github\.com\/.+$/i", trim($gitHubLink)) === 1;
        }

        public static function validExperience(string $value): bool {
            return !empty($value);
        }

        public static function validPhone(string $value): bool {
            return preg_match("/^\d*$/", $value);
        }

        public static function validEmail(string $email): bool {
            return filter_var($email,
                    FILTER_VALIDATE_EMAIL) !== false;
        }
    }