// IIFE, because we are cool :)
(() => {
  document.querySelector("#login-form").addEventListener("submit", function(event) {
    const email = document.getElementById("loginEmail").value;
    const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

    if (!emailRegex.test(email)) {
      alert("Please enter a valid email.");
      event.preventDefault();
    }
  });

  document.querySelector("#register-form").addEventListener("submit", function(event) {
    const email = document.getElementById("registerEmail").value;
    const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

    if (!emailRegex.test(email)) {
      alert("Please enter a valid email.");
      event.preventDefault();
    }
  });
})();

function switchTab(tabName) {
  var loginForm = document.getElementById("loginForm");
  var registerForm = document.getElementById("registerForm");
  var loginTab = document.getElementsByClassName("tab")[0];
  var registerTab = document.getElementsByClassName("tab")[1];

  if (tabName === "login") {
    loginForm.style.display = "block";
    registerForm.style.display = "none";
    loginTab.classList.add("active");
    registerTab.classList.remove("active");
  } else {
    loginForm.style.display = "none";
    registerForm.style.display = "block";
    loginTab.classList.remove("active");
    registerTab.classList.add("active");
  }
}