<?php
    if (isset($_POST['articleSubmit'])) {
        include '../connect.php';
    
        $articleHeader = $_POST['articleHeader'];
        $articleSummary = $_POST['articleSummary'];
        $articleMain = $_POST['articleMain'];
        $articleCategory = strtolower($_POST['articleCategories']);
        $articleImage = $_FILES['articleImage']['name'];
        $articleArchive = 0;
        $date = date('d.m.Y.');

        if(isset($_POST['articleArchive'])){
            $articleArchive = 0;
        }else{
            $articleArchive = 1;
        }

        $target_dir = '../../img/'. $articleImage;
        move_uploaded_file($_FILES["articleImage"]["tmp_name"], $target_dir);

        $query = "INSERT INTO article (date, title, summary, text, picture, category,
        archive ) VALUES ('$date', '$articleHeader', '$articleSummary', 
        '$articleMain', '$articleImage',
        '$articleCategory', '$articleArchive')";

        $result = mysqli_query($dbc, $query) or die('Error querying databese.');
        mysqli_close($dbc);

    }

    //var_dump($_POST);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CompetitionGP.com</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="Race, Racing, Rally, Competition, GP">
    <meta name="description" content="Racing News Website">
    <meta name="author" content="Ivan Piščević">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../article/article1.css">
</head>
<body>
    <header class="header__wrapper">
        <img src="../../img/logo/logo_crop_transparent.png" class="header__wrapper--img" alt="logo">
        <div class="header__wrapper_content">
            <h1>CompetitionGP</h1><br>
            <!-- <p>Home of your motorsport news</p> -->
            <nav class="nav__wrapper">
                <a href="../index/index.php">Home</a>
                <a href="">Formula 1</a>
                <a href="">WRC</a>
                <a href="">Administration</a>
            </nav>
        </div>
    </header>

    <main class="mainArticle__content">
        <div class="mainArticle__content_header">
            <h1 class="mainArticle__content--h1"><?php echo $articleHeader; ?></h1>
            <p class="mainArticle__content_header_date"><?php echo date("d.M.Y"); ?></p>
        </div>
        <h2 class="mainArticle__content--h2"><?php echo $articleSummary; ?></h2>
        <img src="../../img/<?php echo $articleCategory . "/" . $articleImage; ?>" class="mainArticle__content--img">
        <p class="mainArticle__content--p">
            <?php 
                echo $articleMain;
            ?>
        </p>
    </main>

    <footer class="footer__wrapper">
        <p class="footer_content">News from motorsport 2022 | © competitiongp.com | Home</p>
    </footer>
</body>
</html>