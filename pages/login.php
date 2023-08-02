<?
require('../controller/database/connect.php');
require('../controller/database/user.php');
require('../controller/database/function.php');
require('../inc/handle-login.php');
require('../inc/handle-register.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/reponsive.css">
    <link rel="stylesheet" href="../public/css/register.css">
    <link rel="stylesheet" href="../libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</head>
<body>
    <main>

        <div class="container-fluid login-main">
            <div id="toast">
                <div id="img">Icon</div>
                <div id="desc"><? global $mess ;echo $mess;?></div>
            </div>
            <a class="btn-back" href='javascript: history.go(-1)'><i class="fa-solid fa-caret-left"></i><span>Back</span></a>
            <div class="row login-bg">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="login-content">
                        <div>
                            <h1 class="login-content__title">Ashion</h1>
                            <p class="login-content__text">Sitamet, consectetur adipiscing elit, sed do eiusmod tempor
                                incidid-unt labore
                                edolore magna aliquapendisse ultrices gravida.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="login-form">
                        <h6 class="login-form__title">Login</h6>
                        <form class="" action="" method="post">
                            <input type='text' name='txtUsername' placeholder="User name" />
                            <input type='password' name='txtPassword' placeholder="Password" />
                            <input class="btn-submit" type="submit" name="login" value="Login">
                            <p class="form-or">or</p>
                            <input class="btn-submit" id="open-form" type="button" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <section class="register">
        <div class="register-bg">
            <h6 class="register__tite ">Register</h6>
            <div class="close-register">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <form action="" method="post">
                <input type="text" name="txtUsername" placeholder="User name" />
                <input type="password" name="txtPassword" placeholder="Password" />
                <input type="text" name="txtEmail" placeholder="Email" />
                <input type="text" name="txtFullname" placeholder="Full name" />
                <input type="date" name="txtBirthday" placeholder="User name" />
                <select name="txtSex">
                    <option value="">Sex</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Other">Other</option>
                </select>
                <input type="submit" class="btn-submit" value="Register" />
            </form>
        </div>
    </section>
</body>
<script>
    // register event listeners
    let registerForm = document.querySelector('.register');
    let openForm = document.querySelector('#open-form');
    let closeForm = document.querySelector('.close-register');
    openForm.addEventListener('click', function() {
        registerForm.classList.add('open-form');
    });
    closeForm.addEventListener('click', function() {
        registerForm.classList.remove('open-form');
    });
    // Toast function
    function launch_toast() {
        var x = document.getElementById("toast")
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 5000);
    }
    let showToast = <?php echo isset($showToast) && $showToast ? 'true' : 'false'; ?>;
    if(showToast){
        launch_toast();
    }
</script>

</html>