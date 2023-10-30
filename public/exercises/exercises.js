const workouts = document.getElementById('workout');

async function searchExercises() {
    const exerciseInput = document.getElementById("searchExercises");
    const exerciseCategories = document.getElementById("exerciseCategories");
    const exerciseResults = document.getElementById("exerciseResults");
    const usageType = exerciseInput.dataset.usageType;

    const appointmentID = exerciseInput.dataset.appointment ?? null;

    if (exerciseInput.value === "") {
        exerciseCategories.style.display = "block";
        workouts.style.display = "block";
        exerciseResults.style.display = "none";
    } else {
        exerciseCategories.style.display = "none";
        workouts.style.display = "none";


        try {
            const inputValue = exerciseInput.value;
            const response = await fetch(`/coach/search-exercises?q=${inputValue}&usageType=${usageType}&appointment=${appointmentID}`);
            const data = await response.text();

            if (data.length > 0) {
                // Display the results
                exerciseResults.innerHTML = data;

                exerciseResults.style.display = "block";
            } else {
                exerciseResults.innerHTML = "No exercises found.";
                exerciseResults.style.display = "block";
            }
        } catch (error) {
            console.error("Error fetching exercise data: " + error);
        }
    }
}

//get category exercises
const categoryElements = document.querySelectorAll('.category');

categoryElements.forEach(category => {
    category.addEventListener('click', async () => {
        // Retrieve the category ID or other necessary data from the element.
        const categoryID = category.dataset.categoryId;
        const usageType = category.dataset.usageType;
        const appointmentID = category.dataset.appointmentId ?? null;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        workouts.style.display = "none";


        const apiUrl = '/coach/category-exercises'; // Replace with your API URL

        const postData = {
            categoryID: categoryID,
            usageType: usageType,
            appointmentID:appointmentID
        };


        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(postData) // Convert the data to JSON format

        };
        try {
            const response = await fetch(apiUrl, requestOptions);
            if (!response.ok) {
                throw new Error(`HTTP error ${response.status}`);
            }

            const data = await response.text();
            const exerciseResults = document.getElementById('exerciseResults');

            if (data.length > 0) {
                // Display the results
                exerciseResults.innerHTML = data;
                exerciseResults.style.display = "block";
            } else {
                exerciseResults.innerHTML = "No exercises found.";
                exerciseResults.style.display = "block";
            }

        } catch (error) {
            console.error(`Error fetching exercises: ${error}`);
        }

        $(document).on('click', '.submitForm', function() {

            const form = $(this).closest('form');
            form.attr('method', 'POST'); // Set the form method to POST
            form.submit();
        });
    });
});
