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
       <section class="form__section_register">
            <h2>Register</h2>
            <form enctype="multipart/form-data" id="register_form" name="register_form" method="post" action="">
                <label for='firstname'>Firstname: </label><br>
                <input type='text' id='firstname' name='firstname'><br><br>
                <label for='lastname'>Lastname: </label><br>
                <input type='text' id='lastname' name='lastname'><br><br>
                <label for='username'>Username: </label><br>
                <input type='text' id='username' name='username'><br><br>
                <label for='password'>Password: </label><br>
                <input type='password' id='password' name='password'><br><br>
                <label for='password'>Repeat password: </label><br>
                <input type='password' id='password' name='repeatedPassword'><br><br>
                <input type='submit' name='submit' id='submit' class='submitLogin'>

                <?php
                if (isset($_POST['submit'])) {
                    include '../connect.php';

                    if ($dbc) {
                        $correctPassword = false;

                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $repeatedPassword = $_POST['repeatedPassword'];
                        
                        if ($password == $repeatedPassword) {
                            $correctPassword = true;
                        } else {
                            echo "<br>Password and repeated password dont match!<br>";
                        }

                        if ($correctPassword) {
                            $defaultAccessLevel = 0;
                            $hashedPassword = password_hash($password, CRYPT_BLOWFISH);

                            $insertQuery = "INSERT INTO user (firstname, lastname, username, password, accessLevel)
                                            VALUES (?, ?, ?, ?, ?);";

                            $stmt = mysqli_stmt_init($dbc);

                            if (mysqli_stmt_prepare($stmt, $insertQuery)) {
                                mysqli_stmt_bind_param($stmt, 'ssssi', $firstname, $lastname, $username, $hashedPassword, $defaultAccessLevel);
                                mysqli_stmt_execute($stmt);
                                echo "<br>Registration complete!<br>";
                            } else {
                                echo "<br>Failed registration. Please try again.";
                            }
                        }
                    } 
                }
                ?>

            </form>
       </section>
    </main>

    <footer class="footer__wrapper">
        <p class="footer_content">News from motorsport 2022 | © competitiongp.com | Insert</p>
    </footer>
</body>
</html>