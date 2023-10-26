document.addEventListener("DOMContentLoaded", function () {
    const alertElement = document.getElementById("alert");
    const progressElement = document.getElementById("progress");

    setTimeout(function () {
        alertElement.style.display = "none";
    }, 3000);

    function updateProgressBar() {
        const progressBar = document.querySelector(".progress-bar");

        // progressBar.style.border = "4px solid red";
        let width = 100;
        const interval = setInterval(function () {
            if (width >= 1) {
                width--;
                progressBar.style.width = width + "%";
                progressBar.setAttribute("aria-valuenow", width);
            } else {
                console.log(width);
                clearInterval(interval);
            }
        }, 20); // Adjust the interval to control the progress bar speed
    }

    // Show the progress bar and start the progress when the document is ready
    progressElement.style.display = "block";
    updateProgressBar();
});
