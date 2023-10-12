
function toggleLoginForm() {
    var loginForm = document.getElementById("login-form");
    var registerForm = document.getElementById("register-form");
    if (loginForm.style.display === "none" || loginForm.style.display === "") {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
    } else {
        loginForm.style.display = "none";
    }
}
function toggleRegisterForm() {
    var loginForm = document.getElementById("login-form");
    var registerForm = document.getElementById("register-form");
    if (registerForm.style.display === "none" || registerForm.style.display === "") {
        registerForm.style.display = "block";
        loginForm.style.display = "none";
    } else {
        registerForm.style.display = "none";
    }
}

// JavaScript to open/close the sidebar on small screens
const sidebar = document.querySelector('.sidebar');
document.querySelector('.logo').addEventListener('click', () => {
    sidebar.classList.toggle('open');
})

