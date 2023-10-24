@extends('web.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <label class="w-100">
                <input name="search_exercises" id="searchExercises" type="text" class="form-control" value ='' placeholder="Search..."
                       oninput="searchExercises()">
            </label>
        </div>

        <div class="col-12" id="exerciseCategories">
            <div class="card" >
                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        @foreach($categories as $category)
                            <li class="d-flex justify-content-between align-items-center list-group-item category"
                                data-category-id="{{$category->id}}">
                                {{ $category->name }}
                                <span class="badge border border-warning rounded-pill font-15 ">
                                    {{ $category->exercises_count }}
                                </span>

                            </li>
                        @endforeach



                    </ul>
                </div>
            </div>
        </div>

        <div id="exerciseResults"></div>
    </div>
@endsection

@section('scripts')


    <script>
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
                        exerciseResults.innerHTML=data;

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
                        exerciseResults.innerHTML=data;

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
    </script>
@endsection
