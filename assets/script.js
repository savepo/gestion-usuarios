console.log("Script loaded");

function emailValido(email) {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function handleFormSubmit(formId, actionUrl) {
  console.log("Setting up form", formId);
  const form = document.getElementById(formId);
  console.log("Form element", form);
  if (!form) {
    console.log("Form not found, skipping", formId);
    return;
  }
  const emailInput = form.querySelector("input[name='email']");
  const passwordInput = form.querySelector("input[name='password']");
  const usernameInput = form.querySelector("input[name='username']");
  const newUsernameInput = form.querySelector("input[name='new_username']");
  const message = document.querySelector("#message");
  const loading = document.querySelector("#loading");

  form.addEventListener("submit", function (event) {
    console.log("Form submitted", formId);
    event.preventDefault();

    // Limpiar errores previos
    document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    if (message) message.textContent = "";
    if (loading) loading.style.display = "block";

    // Validación basada en form
    let isValid = true;
    if (formId === 'registerForm') {
      if (!usernameInput || !usernameInput.value.trim()) {
        if (usernameInput) usernameInput.classList.add('error');
        if (message) message.textContent = "Username is required";
        isValid = false;
      }
      if (!emailInput || !emailInput.value.trim()) {
        if (emailInput) emailInput.classList.add('error');
        if (message) message.textContent = "Email is required";
        isValid = false;
      } else if (!emailValido(emailInput.value)) {
        if (emailInput) emailInput.classList.add('error');
        if (message) message.textContent = "El email no tiene un formato válido";
        isValid = false;
      }
      if (!passwordInput || !passwordInput.value.trim()) {
        if (passwordInput) passwordInput.classList.add('error');
        if (message) message.textContent = "Password is required";
        isValid = false;
      }
    } else if (formId === 'loginForm') {
      if (!emailInput || !emailInput.value.trim()) {
        if (emailInput) emailInput.classList.add('error');
        if (message) message.textContent = "Email or username is required";
        isValid = false;
      }
      if (!passwordInput || !passwordInput.value.trim()) {
        if (passwordInput) passwordInput.classList.add('error');
        if (message) message.textContent = "Password is required";
        isValid = false;
      }
    } else if (formId === 'updateForm') {
      if (!newUsernameInput || !newUsernameInput.value.trim()) {
        if (newUsernameInput) newUsernameInput.classList.add('error');
        if (message) message.textContent = "New username is required";
        isValid = false;
      }
    }

    if (!isValid) {
      if (loading) loading.style.display = "none";
      return;
    }

    fetch(actionUrl, {
      method: "POST",
      body: new FormData(form)
    })
      .then(res => res.json())
      .then(data => {
        console.log(data);
        console.log("formId:", formId);
        if (message) {
          message.textContent = data.message;
          message.style.color = data.success ? "green" : "red";
        }

        if (data.success && formId === "loginForm") {
          console.log("Redirecting to dashboard");
          window.location.href = "dashboard.php";
        }

        if (data.success && formId === "updateForm") {
          console.log("Redirecting to dashboard after update");
          window.location.href = "dashboard.php";
        }

        if (data.success) {
          form.reset();
        }
      })
      .catch(error => {
        console.log("Fetch error:", error);
        if (message) {
          message.textContent = "Error de conexión";
          message.style.color = "red";
        }
      })
      .finally(() => {
        if (loading) loading.style.display = "none";
      });
  });
}

window.addEventListener("DOMContentLoaded", () => {
  handleFormSubmit("registerForm", "../controllers/register.php");
  handleFormSubmit("loginForm", "../controllers/login.php");
  handleFormSubmit("updateForm", "../controllers/update_profile.php");

  // Logout button
  const logoutBtn = document.getElementById("logoutBtn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", () => {
      fetch("../controllers/logout.php", { method: "POST" })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            window.location.href = "index.html";
          }
        });
    });
  }
});
