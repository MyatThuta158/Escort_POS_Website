///////////---This is for register form validation---///////

document.addEventListener("DOMContentLoaded", function () {
  let form = document.querySelector("#aRegisterform");
  let password = document.querySelector("#password");

  password.addEventListener("input", () => {
    let passwordValue = password.value;
    var passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    let invalid = document.querySelector(".password-invalid");
    if (!passwordRegex.test(passwordValue)) {
      invalid.style.display = "block";
    } else {
      invalid.style.display = "none";
    }
  });

  form.addEventListener("submit", (e) => {
    let passwordValue = password.value;
    var passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    let invalid = document.querySelector(".password-invalid");
    if (!passwordRegex.test(passwordValue)) {
      e.preventDefault();
      invalid.style.display = "block";
    } else {
      invalid.style.display = "none";
    }

    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }

    form.classList.add("was-validated");
  });
});

//////////////////-------------This is for normal form validation----------//
document.addEventListener("DOMContentLoaded", () => {
  let form = document.querySelector(".rForm");

  //------This is function for form validation-----------//
  form.addEventListener("submit", (e) => {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }

    form.classList.add("was-validated");
  });
});
