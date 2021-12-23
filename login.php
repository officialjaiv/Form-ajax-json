<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="loginstyle.css">
    <title>Login Foam</title>
</head>

<body>

    <form id="login" class="login-form">

        <h1>Sign In</h1>
        <div class="textb">
            <input type="text" id="txt_uname" class="uname" name="Email" required>
            <div class="placeholder">Username</div>
        </div>

        <div class="textb">
            <input type="password" id="txt_pwd" class="pass" name="Password" required>
            <div class="placeholder">Password</div>
            <div class="show-password fas fa-eye-slash"></div>
        </div>

        <div class="checkbox">
            <input type="checkbox">
            <div class="fas fa-check"></div>
            Stay Signed in
        </div>

        <button type="submit" class="btn fas fa-arrow-right btn_submit" disabled></button>
        <input type="hidden" name="hidden_login" value="yes">
        <a href="#"> Can't Sign in? </a>
        <a href="#"> Create Account </a>

    </form>

    <script>

        $('.btn_submit').attr("disabled", 'disabled');
        $('.login-form').keypress(function () {

            if ($('.pass').val() != '' && $('.uname').val() != '') {
                $('.btn_submit').removeAttr('disabled');
            } else {
                $('.btn_submit').attr("disabled", 'disabled');
            }
        });

        $(".show-password").on("click", function () {

            if (this.classList[2] == "fa-eye-slash") {
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
                $('.pass').attr("type", 'text');
            }
            else {
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
                $('.pass').attr("type", 'password');
            }
        });


        //for user login 

        $("body").on("submit", "#login", function () {
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'ajaxfun.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var data = data.trim()
                    if (data == '0') {
                       alert('Invalid username and password!'); 
                    }
                    if (data == 'Yes') {
                        window.location = "home.php";
                    }
                }
            });
            return false;
        });
    </script>

</body>

</html>