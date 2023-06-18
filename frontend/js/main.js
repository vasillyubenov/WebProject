// IIFE, because we are cool :)
(() => {
  document.querySelector("#login-form").addEventListener("submit", function(event) {
    event.preventDefault();
    const email = document.getElementById("loginEmail").value;
    const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    const password = document.getElementById("loginPassword").value;

    if (!emailRegex.test(email)) {
      alert("Please enter a valid email.");
      return;
    }

    const formData = {
      "email": email,
      "password": password
    };
    
    fetch('../../backend/login.php', {
      method: 'POST',
      body: JSON.stringify(formData),
      headers: {
          'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.message) {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });

  document.querySelector("#register-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const email = document.getElementById("registerEmail").value;
    const password = document.getElementById("registerPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

    if (!emailRegex.test(email)) {
      alert("Please enter a valid email!");
      return;
    }

    if (confirmPassword !== password) {
      alert("Please enter same passwords!");
      return;
    }

    const formData = {
      "email": email,
      "password": password
    };
    
    fetch('../../backend/register.php', {
      method: 'POST',
      body: JSON.stringify(formData),
      headers: {
          'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        switchTab('login');
        alert(data.message);
      }
      else {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
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