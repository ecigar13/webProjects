$(document).ready(function () {
  $("#username").focusin(function () {
    $("#nameInfo").remove();
    $(this).after("<span class='info' id='nameInfo'>Username must only contain alphanumeric or numeric characters.</span>");
  });

  //username has numeric, alphanumeric
  $("#username").blur(function () {
    var nameVal = this.value;
    var name = this.value.match(/([^A-Za-z0-9])/g);
    console.log(name);
    if (!nameVal) {
      $("#nameInfo").remove();
    } else if (name) {
      $("#nameInfo").attr('class', 'error');
    } else {
      $("#nameInfo").attr('class', 'ok').html("Good!");
    }
  });


  //password field is 6 char long
  $("#password").focusin(function () {
    $("#pwdInfo").remove();
    $(this).after("<span class='info' id='pwdInfo'>Password must be longer than 6 characters.</span>");
  });

  $("#password").on('blur', function () {
    var pswd = $(this).val();

    if (!pswd) {
      $("#pwdInfo").remove();
    } else if (pswd.length < 6) {
      $("#pwdInfo").attr('class', 'error');
    } else {
      $("#pwdInfo").attr('class', 'ok').html("Good!");
    }
  });

  $("#email").focusin(function () {
    $("#emailInfo").remove();
    $(this).after("<span class='info' id='emailInfo'>Email must have an @.</span>");
  });


  //check email
  $("#email").on('blur', function () {
    //credit: https://emailregex.com/
    var mail = this.value.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);
    var emailAddr = this.value;
    console.log(mail);
    if (!emailAddr) {
      $("#emailInfo").remove();
    } else if (mail) {
      $("#emailInfo").attr('class', 'ok').html("Good!");
    } else {
      $("#emailInfo").attr('class', 'error');
    }
  });
});