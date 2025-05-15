document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("theme");
    const body = document.body;
  
    // Zustand aus localStorage laden
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
      toggle.checked = true;
      body.classList.add("dark");
    }
  
    // Beim Umschalten des Toggles
    toggle.addEventListener("change", () => {
      if (toggle.checked) {
        body.classList.add("dark");
        localStorage.setItem("theme", "dark");
      } else {
        body.classList.remove("dark");
        localStorage.setItem("theme", "light");
      }
    });
  });