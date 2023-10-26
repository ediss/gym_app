async function searchExercises() {
    const exerciseInput = document.getElementById("searchExercises");
    const exerciseCategories = document.getElementById("exerciseCategories");
    const exerciseResults = document.getElementById("exerciseResults");

    if (exerciseInput.value === "") {
        exerciseCategories.style.display = "block";
        exerciseResults.style.display = "none";
    } else {
        exerciseCategories.style.display = "none";

        try {
            const inputValue = exerciseInput.value;
            const response = await fetch(`/coach/search-exercises?q=${inputValue}`);
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
        const categoryId = category.dataset.categoryId;

        try {
            const response = await fetch(`/coach/category-exercises/${categoryId}`);
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
    });
});
