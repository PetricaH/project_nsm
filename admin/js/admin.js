// admin.js
document.addEventListener("DOMContentLoaded", () => {
    // Base URL logic: adapt if your folder structure differs
    const BASE_URL = `${window.location.origin}${window.location.pathname
      .split("/")
      .slice(0, -1)
      .join("/")}/`;
    
    const links = document.querySelectorAll(".tab");
    const mainContent = document.querySelector(".main_content");
  
    // Load default page on initial load
    const defaultPage = "manage_blog"; 
    loadPage(defaultPage, false);
  
    // -----------------------------------------
    // Handle sidebar navigation clicks
    // -----------------------------------------
    links.forEach(link => {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        const page = link.getAttribute("href").split("=")[1];
  
        loadPage(page, true); // Push to history
  
        // Highlight the active link
        links.forEach(l => l.classList.remove("active"));
        link.classList.add("active");
      });
    });
  
    // -----------------------------------------
    // Main function to fetch + insert page HTML
    // -----------------------------------------
    function loadPage(page, pushToHistory = true) {
      // Before loading a new page, destroy existing CKEditor instances
      destroyAllEditors();
  
      // Fetch the PHP partial for that page
      fetch(`${BASE_URL}${page}.php`)
        .then(response => {
          if (!response.ok) throw new Error("Page not found");
          return response.text();
        })
        .then(data => {
          // Insert content into .main_content
          mainContent.innerHTML = data;
  
          // Update the browser history
          if (pushToHistory) {
            history.pushState({ page }, "", `?page=${page}`);
          }
  
          // Load page-specific CSS
          loadPageCSS(page);
  
          // Load page-specific JS (e.g. manage_blog.js)
          loadPageScript(page);
        })
        .catch(error => {
          console.error(error);
          mainContent.innerHTML = `<h1>${error.message}</h1>`;
        });
    }

    window.loadPage = loadPage;
  
    // -----------------------------------------
    // Dynamically load page-specific CSS
    // -----------------------------------------
    function loadPageCSS(page) {
      const cssMap = {
        manage_artwork: "manage_artworks.css",
        manage_bookings: "manage_bookings.css",
        manage_users: "manage_users.css",
        manage_blog: "manage_blog.css",
      };
  
      // Remove any previously loaded CSS for a different page
      const existingCSS = document.getElementById("page-specific-css");
      if (existingCSS) {
        existingCSS.remove();
      }
  
      // Create a new <link> for the target page's CSS
      const linkElement = document.createElement("link");
      linkElement.id = "page-specific-css";
      linkElement.rel = "stylesheet";
      linkElement.type = "text/css";
      linkElement.href = `../admin/admin_styles/${cssMap[page] || (page + ".css")}`;
  
      document.head.appendChild(linkElement);
    }
  
    // -----------------------------------------
    // Dynamically load page-specific JS
    // -----------------------------------------
    function loadPageScript(page) {
      // If you have separate JS for each page, map them here
      const scriptMap = {
        manage_blog: "manage_blog.js",
        // manage_users: "manage_users.js",
        // manage_artwork: "manage_artwork.js", etc.
      };
  
      // Remove existing <script> for a previous page
      const existingScript = document.getElementById("page-specific-script");
      if (existingScript) {
        existingScript.remove();
      }
  
      if (scriptMap[page]) {
        const scriptElement = document.createElement("script");
        scriptElement.id = "page-specific-script";
        scriptElement.src = `../admin/js/${scriptMap[page]}`;
        // IMPORTANT: If you want to run initialization after the script loads, do:
        scriptElement.onload = () => {
          // If the script defines a global init function, call it here:
          if (typeof window.initManageBlog === "function" && page === "manage_blog") {
            window.initManageBlog();
          }
        };
        document.body.appendChild(scriptElement);
      }
    }
  
    // -----------------------------------------
    // CKEditor cleanup
    // -----------------------------------------
    function destroyAllEditors() {
      for (let instance in CKEDITOR.instances) {
        if (CKEDITOR.instances.hasOwnProperty(instance)) {
          CKEDITOR.instances[instance].destroy(true);
        }
      }
    }
  
    // -----------------------------------------
    // Handle browser back/forward buttons
    // -----------------------------------------
    window.addEventListener("popstate", (event) => {
      const page = event.state?.page || "manage_artwork";
      loadPage(page, false); // false => do not push to history again
    });
  });
  