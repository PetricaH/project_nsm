document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".tab"); // select all sidebar links
    const mainContent = document.querySelector(".main_content"); // select the main content area

    // add click event listeners to all sidebar links
    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault(); // prevent default link behaviour
            const page = link.getAttribute("href").split("=")[1]; // extract the 'page' parameter from the URL

            // fetch the content dynamically
            fetch(`admin/${page}.php`)
                .then(response => {
                    if (!response.ok) throw new Error("Page not found"); // handle HTTP errors
                    return response.text(); // parse the response as text (HTML)
                })
                .then(data => {
                    mainContent.innerHTML = data; // inject the fetched HTML into the main content area
                })
                .catch(error => {
                    mainContent.innerHTML = <h1>${error.messagge}</h1>; // display an error message
                });
        });
    });

    // code for making drag and drop images doable

    const dropZone = document.getElementById("drop_zone");
    const fileInput = document.getElementById("image");
    const preview = document.getElementById("preview");

    // highlight drop zone when file is dragged over
    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZone.classList.add("dragging");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("dragging");
    });

    // handle file drop
    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        dropZone.classList.remove("dragging");

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files; // attach dropped files to the input 
            previewImage(files[0]);
        }
    });

    // handle file selection through input
    fileInput.addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
            previewImage(e.target.files[0]);
        }
    });

    // preview the image
    function previewImage(file) {
        preview.innerHTML = ""; // clear previous preview
        if (file && file.type.startsWith("image/")) {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file); // create a temporary URL for the image
            img.alt = "Preview";
            img.style.maxWidth = "100%";
            img.style.maxHeight = "200px";
            preview.appendChild(img);
        } else {
            preview.innerHTML = "<p>Invalid file type. Please select an image.</p>";
        }
    }

    // code for making drag and drop images doable ||
}); 