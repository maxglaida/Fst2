<?php
include_once '../inc/head.php';
include_once '../utility/DB.php';
$db = new DB();


$pw = null;
$user = null;

if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if (isset($_POST['rememberme'])) {
            setcookie('username', $_POST['username']);
            setcookie('password', $_POST['password']);
        }
        $db->checkUser($_POST['username'], ($_POST['password']));
    }
}
?>

    <div class="container">
        <form class="form-signin" action="index.php?id=3" method="post">
            <h2 class="form-signin-heading">User login</h2>
            <input type="text" id="usern" name="username" class="form-control" placeholder="Username" required >
            <input type="password" id="pass" name="password" class="form-control" placeholder="Password" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="rememberme" value="rememberme"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Log in</button>
        </form>

    </div>

<?php
if (isset($_COOKIE['username']) & isset($_COOKIE['password'])) {
    $user = $_COOKIE['username'];
    $pass = $_COOKIE['password'];
    echo ("<script language='JavaScript'>
          document.getElementById('usern').value= '$user';
          document.getElementById('pass').value= '$pass';
              </script>");
}

include_once '../inc/footer.php';
?>