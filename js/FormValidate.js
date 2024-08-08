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

function updateFileName(input) {
  var fileName = input.files[0].name;
  var label = input.nextElementSibling;
  label.innerText = fileName;
}
