<!DOCTYPE html>
<html>
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
    $id = $_GET['id'];
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
                <a href="../administration/administration.php?id=<?php echo $id; ?>">Administration</a>
                <a href="../insert/unos.html">Insert</a>
            </nav>
        </div>
    </header>

    <main class="mainArticle__content">
        <?php
            $title = '';
            $date = '';
            $summary = '';
            $text = '';
            $picture = '';
            $category = '';

            $query = "SELECT * FROM article
                        WHERE id=$id";
            $result = mysqli_query($dbc, $query);
            
            if ($result) {
                if ($row = mysqli_fetch_array($result)) {
                    $title = $row['title'];
                    $date = $row['date'];
                    $summary = $row['summary'];
                    $text = $row['text'];
                    $picture = $row['picture'];
                    $category = $row['category'];
                }
            }
        ?>

        <div class="mainArticle__content_header">
            <h1 class="mainArticle__content--h1"><?php echo $title; ?></h1>
            <p class="mainArticle__content_header_date"><?php echo $date; ?></p>
        </div>
        <h2 class="mainArticle__content--h2"><?php echo $summary; ?></h2>
        <?php echo "<img src='" . UPLPATH . $row['picture'] . "' class='mainArticle__content--img'>"; ?>
        <p class="mainArticle__content--p"><?php echo $text; ?></p>
    </main>

    <footer class="footer__wrapper">
        <p class="footer_content">News from motorsport 2022 | © competitiongp.com | <?php echo strtoupper($category); ?></p>
    </footer>
</body>
</html>