<!DOCTYPE html>
<html lang="en">
<head>
    <title>CompetitionGP.com</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Race, Racing, Rally, Competition, GP">
    <meta name="description" content="Racing News Website">
    <meta name="author" content="Ivan Piščević">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index/style.css">

    <?php
    include '../connect.php';
    define('UPLPATH', '../../img/');
    //$category = $_GET['id'];
    $query = '';
    $result = '';
    ?>

</head>
<body>
    <header class="header__wrapper">
        <img src="../../img/logo/logo_crop_transparent.png" class="header__wrapper--img" alt="logo">
        <div class="header__wrapper_content">
            <h1>CompetitionGP</h1><br>
            <nav class="nav__wrapper">
                <a href="../index/index.php">Home</a>
                <a href="../category/category.php?id=formula1">Formula 1</a>
                <a href="../category/category.php?id=wrc">WRC</a>
                <a href="#">Administration</a>
                <a href="../insert/unos.html">Insert</a>
                <a href="../login/login.php">Login</a>
            </nav>
        </div>
    </header>

    <main class="main__wrapper">
        <section class="main__firstSection">
            <?php
            echo "<h2 class='categoryTitle'>All News - choose article to edit ></h2>";
            ?>
            <section class="main__firstSection_content">
                <?php
                    $query = "SELECT * FROM article
                    ORDER BY STR_TO_DATE(article.date, '%d.%m.%Y') DESC";
                    $result = mysqli_query($dbc, $query);

                    if ($result) {
                        while($row = mysqli_fetch_array($result)) {
                            echo "
                            <article class='newsArticle'>
                                <a class='linkToArticle' style='text-decoration: none; color: black; 'href='../administration/administration.php?id=" . $row['id'] . "'>
                                    <img src='" . UPLPATH . $row['picture'] . "'>
                                    <p>" . strtoupper($row['category']) . "</p>
                                    <h3 class='articleTitle'>". $row['title'] . "</h3>
                                </a>
                            </article>";
                        }
                    }
                ?>
            </section>
        </section>
    </main>

    <footer class="footer__wrapper">
        <p class="footer_content">News from motorsport 2022 | © competitiongp.com | Administration</p>
    </footer>
</body>
</html>