const exerciseInput = document.querySelector("#searchExercises");
const exerciseCategories = document.querySelector("#exerciseCategories");
const exerciseResults = document.querySelector("#exerciseResults");
const workouts = document.querySelector('#workout');
const categoryElements = document.querySelectorAll('.category');
let lastClickedCategoryID = null;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Function to toggle display of workouts
function toggleWorkouts() {
    if (workouts) {
        if (workouts.style.display === "none") {
            hideElement(exerciseResults);
            showElement(workouts);
        } else {
            hideElement(workouts);
            showElement(exerciseResults);
        }
    }
}

// Function to handle category click event
async function handleCategoryClick(category) {
    const categoryID = category.dataset.categoryId;
    const usageType = category.dataset.usageType;
    const appointmentID = category.dataset.appointmentId || null;

    if (workouts && lastClickedCategoryID === categoryID) {
        toggleWorkouts();
        return;
    }

    hideElement(workouts);

    const apiUrl = '/coach/category-exercises/' + categoryID;
    const postData = { usageType, appointmentID };

    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(postData)
    };

    try {
        const response = await fetch(apiUrl, requestOptions);
        if (!response.ok) {
            throw new Error(`Failed to fetch exercises (${response.status})`);
        }

        const data = await response.text();
        if (data.length > 0) {
            exerciseResults.innerHTML = data;
            showElement(exerciseResults);
        } else {
            exerciseResults.innerHTML = "No exercises found.";
            showElement(exerciseResults);
        }

        lastClickedCategoryID = categoryID;
    } catch (error) {
        console.error(`Error fetching exercises: ${error}`);
    }
}

// Function to handle search exercises
async function searchExercises() {
    const inputValue = exerciseInput.value;
    const appointmentID = exerciseInput.dataset.appointment || null;
    const usageType = exerciseInput.dataset.usageType;

    if (inputValue === "") {
        showElement(exerciseCategories);
        showElement(workouts);
        hideElement(exerciseResults);
    } else {
        hideElement(exerciseCategories);
        hideElement(workouts);

        const apiUrl = `/coach/search-exercises?q=${inputValue}&usageType=${usageType}&appointment=${appointmentID}`;

        try {
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error(`Failed to fetch exercises (${response.status})`);
            }

            const data = await response.text();
            if (data.length > 0) {
                exerciseResults.innerHTML = data;
                showElement(exerciseResults);
            } else {
                exerciseResults.innerHTML = "No exercises found.";
                showElement(exerciseResults);
            }
        } catch (error) {
            console.error(`Error fetching exercises: ${error}`);
        }
    }
}

// Utility functions
function hideElement(element) {
    if (element) {
        element.style.display = "none";
    }
}

function showElement(element) {
    if (element) {
        element.style.display = "block";
    }
}

// Event listeners
$(document).on('click', '.submitForm', function () {
    const form = $(this).closest('form');
    form.submit();
});

categoryElements.forEach(category => {
    category.addEventListener('click', () => handleCategoryClick(category));
});

exerciseInput.addEventListener('input', searchExercises);

// Initial display setup
function initializeDisplay() {
    showElement(exerciseCategories);
    showElement(workouts);
    hideElement(exerciseResults);
}

initializeDisplay();
