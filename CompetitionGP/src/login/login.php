<!DOCTYPE html>
<html lang="en">
<head>
    <title>CompetitionGP.com</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Race, Racing, Rally, Competition, GP">
    <meta name="description" content="Racing News Website">
    <meta name="author" content="Ivan Piščević">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index/style.css?<?=time()?>">
</head>
<body>
    <header class="header__wrapper">
        <img src="../../img/logo/logo_crop_transparent.png" class="header__wrapper--img" alt="logo">
        <div class="header__wrapper_content">
            <h1>CompetitionGP</h1><br>
            <!-- <p>Home of your motorsport news</p> -->
            <nav class="nav__wrapper">
                <a href="../index/index.php">Home</a>
                <a href="../category/category.php?id=formula1">Formula 1</a>
                <a href="../category/category.php?id=wrc">WRC</a>
                <a href="../administration/allNews.php">Administration</a>
                <a href="../insert/unos.html">Insert</a>
                <a href="../login/login.php">Login</a>
            </nav>
        </div>
    </header>

    <main class="article__wrapper">
       <section class="form__section_login">
            <h2>Login</h2>
            <form enctype="multipart/form-data" id="login_form" name="login_form" method="post" action="">
                <label for='username'>Username: </label><br>
                <input type='text' id='username' name='username'><br><br>
                <label for='password'>Password: </label><br>
                <input type='password' id='password' name='password'><br><br>
                <input type='submit' name='submit' id='submit' class='submitLogin'>

                <?php
                if (isset($_POST['submit'])) {
                    include '../connect.php';

                    if ($dbc) {
                        $username = "";
                        $hashedPassword = "";
                        $accessLevel = 0;

                        $selectQuery = "SELECT user.username, user.password, user.accessLevel
                                        FROM user
                                        WHERE user.username = ?;";

                        $stmt1 = mysqli_stmt_init($dbc);

                        if (mysqli_stmt_prepare($stmt1, $selectQuery)) {
                            mysqli_stmt_bind_param($stmt1, 's', $_POST['username']);
                            mysqli_stmt_execute($stmt1);
                            mysqli_stmt_store_result($stmt1);
                        }

                        mysqli_stmt_bind_result($stmt1, $username, $hashedPassword, $accessLevel);
                        mysqli_stmt_fetch($stmt1);

                        if ($username == $_POST['username'] && password_verify($_POST['password'], $hashedPassword)) {

                            // Session start
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['accessLevel'] = $accessLevel;
                            echo "<p style='color: green;'>Login successful!</p>";
                        } else {
                            echo "<p style='color: red;'>Wrong username or password!</p>";
                        }
                    }
                }
                ?>
            </form>
            <p>If you dont have an account, you can <a href="register.php" class="form__section_register_link">register on this link</a></p>
       </section>
    </main>

    <footer class="footer__wrapper">
        <p class="footer_content">News from motorsport 2022 | © competitiongp.com | Login</p>
    </footer>
</body>
</html>