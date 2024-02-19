<?php
    /*
     * Huy Le
     * Joo Application Version 3
     * data.php
     * This file handles the storage of information from personal, experience, and mail HTML forms.
     * It also displays all the stored information on the summary.html page.
     */
    class Data
    {
        function getPersonalInfoFields(): array
        {
            return ['first_name', 'last_name', 'email', 'phone'];
        }

        function getOptionalPersonalInfoFields(): array
        {
            return ['state'];
        }

        function getExperienceFields(): array
        {
            return ['experience'];
        }

        function getOptionalExperienceFields(): array
        {
            return ['github', 'relocate', 'bio'];
        }
    }