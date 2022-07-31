var alertPlaceholder = document.getElementById("liveAlertPlaceholder");
var alertTrigger = document.getElementById("liveAlertBtn");
const form = document.getElementById("form");
const userName = document.getElementById("username");
const passWord = document.getElementById("password");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  validateForm();
});

function validateForm() {
  let usernameValue = userName.value.trim();
  let passwordValue = passWord.value.trim();

  if (usernameValue === "" && passwordValue === "") {
    alert("Please fill up the form!", "danger");
  } else if (usernameValue === "") {
    alert("Username is empty!", "danger");
  } else if (passwordValue === "") {
    alert("Password is empty!", "danger");
  }
}

function alert(message, type) {
  var wrapper = document.createElement("div");
  wrapper.innerHTML =
    '<div class="alert alert-' +
    type +
    ' alert-dismissible" role="alert">' +
    message +
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

  alertPlaceholder.append(wrapper);
}
