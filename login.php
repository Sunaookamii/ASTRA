<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Page</title>

</head>
<body>
    <div class="loginform">
        <div class="inputgroup">
            <input type="text" id="txtUsername" required>
            <label for= "txtUsername" id="lblUsername">USERNAME</label>
        </div>

        <div class="inputgroup topmargin">
            <input type="password" id="txtPassword" required>
            <label for= "txtPassword" id="lblPassword">PASSWORD</label>
        </div>

        <div class="divcallforaction topmarginbtn">
            <input type="button" class="btnlogin inactivecolor" id="btnlogin" value="Login"></button>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/login.js"></script>
</body>
</html>