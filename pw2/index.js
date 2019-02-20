function formSubmit() {
  validatePassword();
}

function validatePassword() {
  var fname = document.getElementById("fname");
  var lname=document.getElementById("lname");
  var email=document.getElementById("email");
  var password = document.getElementById("password");
  var confirm_password = document.getElementById("confirm_password");
  var checked = document.getElementsByClassName("form-check").checked;
  console.log(password.value);
  if (password.value !== confirm_password.value || password.value == null ||
    password.value == '') {
    confirm_password.setCustomValidity("Passwords Don't Match");
    confirm_password.style.border="red";
    alert("Form cannot be submitted due to validation errors.");
  } else if(checked == false){
    document.getElementsByClassName("form-check").style.border="red";
  } else {

    //submit form
    confirm_password.setCustomValidity("");
    document.forms["signUp"].submit();
    alert("Form is successfully submitted.");
  }

}