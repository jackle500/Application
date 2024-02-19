/*
* Huy Le
* Joo Application Version 2
* scripts.js
* This file handle all the storing information from personal, experience, mail HTML
* And display all the information being stored onto the summary.html
* */

// Function to save personal information to sessionStorage
function savePersonalInformation() {
    const firstName = document.getElementById('inputFName').value;
    const lastName = document.getElementById('inputLName').value;
    const email = document.getElementById('inputEmail').value;
    const state = document.getElementById('state').value;
    const phone = document.getElementById('phone').value;

    sessionStorage.setItem('firstName', firstName);
    sessionStorage.setItem('lastName', lastName);
    sessionStorage.setItem('email', email);
    sessionStorage.setItem('state', state);
    sessionStorage.setItem('phone', phone);
}

// Function to save experience information to sessionStorage
function saveExperienceInformation() {

    const github = document.getElementById('github').value;
    //This will create a for loop check which option for the Year experience is selected
    const yearOptions = document.getElementsByName('year');
    let selectedYear = '';

    for (let i = 0; i < yearOptions.length; i++) {
        if (yearOptions[i].checked) {
            selectedYear = yearOptions[i].value;
            break; // Exit the loop once a selection is found
        }
    }
//This will create a for loop check which option for the relocation is selected
    const relocateOptions = document.getElementsByName('relocate');
    let selectedRelocate = '';

    for (let i = 0; i < relocateOptions.length; i++) {
        if (relocateOptions[i].checked) {
            selectedRelocate = relocateOptions[i].value;
            break; // Exit the loop once a selection is found
        }
    }

    const biography = document.getElementById('biography').value;


    sessionStorage.setItem('github', github);
    sessionStorage.setItem('experienceYear', selectedYear);
    sessionStorage.setItem('willingToRelocate', selectedRelocate);
    sessionStorage.setItem('biography', biography);
}

function saveMailInformation() {
    event.preventDefault();1
    // Initialize an empty array to store the checked values
    let checkedValues = [];

    // Get all the checkbox elements within the form
    const checkboxes = document.querySelectorAll('#formPage3 .form-check-input');

    // Iterate over each checkbox
    checkboxes.forEach((checkbox) => {
        // Check if the checkbox is checked
        if (checkbox.checked) {
            // Add the value of the checked checkbox to the array
            checkedValues.push(checkbox.value);
        }
    });

    // Store the array in sessionStorage
    sessionStorage.setItem('checkedOptions', JSON.stringify(checkedValues));

    // Redirect to the summary page or perform any other action
    window.location.href = 'summary.html';
}

// Function to display personal information on the summary page
function displayPersonalInformation() {
    document.getElementById('summaryFirstName').innerText = sessionStorage.getItem('firstName');
    document.getElementById('summaryLastName').innerText = sessionStorage.getItem('lastName');
    document.getElementById('summaryEmail').innerText = sessionStorage.getItem('email');
    document.getElementById('summaryState').innerText = sessionStorage.getItem('state');
    document.getElementById('summaryPhone').innerText = sessionStorage.getItem('phone');
    document.getElementById('summaryGithub').innerText = sessionStorage.getItem('github');
    document.getElementById('experienceYear').innerText = sessionStorage.getItem('experienceYear');
    document.getElementById('willingToRelocate').innerText = sessionStorage.getItem('willingToRelocate');
    document.getElementById('biography').innerText = sessionStorage.getItem('biography');
}

// Function to display selected skills
function displaySelectedSkills() {
    // Retrieve the array from sessionStorage and parse it back into an array
    const checkedOptions = JSON.parse(sessionStorage.getItem('checkedOptions')) || [];

    // Convert the array of checked options into a formatted string
    const formattedOptions = checkedOptions.join(', ');

    // Find the table cell with the id "selectedSkills" and set its innerHTML to the formatted string
    document.getElementById('selectedSkills').innerHTML = formattedOptions;

};

