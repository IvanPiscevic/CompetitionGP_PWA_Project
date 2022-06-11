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
    $category = $_GET['id'];
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
                <a href="category.php?id=formula1">Formula 1</a>
                <a href="category.php?id=wrc">WRC</a>
                <a href="../administration/administration.php">Administration</a>
                <a href="../insert/unos.html">Insert</a>
            </nav>
        </div>
    </header>

    <main class="main__wrapper">
        <section class="main__firstSection">
            <?php
            if ($category == "formula1") {
                echo "<h2 class='categoryTitle'>Formula 1 ></h2>";
            } else if ($category == "wrc") {
                echo "<h2 class='categoryTitle'>WRC ></h2>";
            }
            ?>
            <section class="main__firstSection_content">
                <?php
                    if ($category == "formula1") {
                        $query = "SELECT * FROM article
                                WHERE category = 'formula1'
                                ORDER BY STR_TO_DATE(article.date, '%d.%m.%Y') DESC";
                        $result = mysqli_query($dbc, $query);
                    } else if ($category == "wrc") {
                        $query = "SELECT * FROM article
                                WHERE category = 'wrc'
                                ORDER BY STR_TO_DATE(article.date, '%d.%m.%Y') DESC";
                        $result = mysqli_query($dbc, $query);
                    } 

                    if ($result) {
                        $i = 1;
                        while($row = mysqli_fetch_array($result)) {
                            echo "
                            <article class='newsArticle'>
                                <a class='linkToArticle' style='text-decoration: none; color: black; 'href='../article/article.php?id=" . $row['id'] . "'>
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
        <p class="footer_content">News from motorsport 2022 | © competitiongp.com | Home</p>
    </footer>
</body>
</html>