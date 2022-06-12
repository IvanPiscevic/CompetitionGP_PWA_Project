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
    $articleId = $_GET['id'];
    $archive = 0;
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
                <a href="allNews.php">Administration</a>
                <a href="../insert/unos.html">Insert</a>
            </nav>
        </div>
    </header>

    <main class="article__wrapper">
       <section class="form__section">
            <h2>Update or Delete an article</h2>
            <?php 
                $query = "SELECT * FROM article
                            WHERE id=$articleId";

                $result = mysqli_query($dbc, $query);

                if ($result) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "<form enctype='multipart/form-data' name='insert_form' method='post' action=''>
                            <div class='form_header_wrapper'>
                                <label for='articleHeader'>Article Header:</label>
                                <input class='form_header' name='articleHeader' type='text' value='" . $row['title'] . "'>
                            </div>

                            <label for='articleSummary'>Article summary:</label><br>
                            <textarea class='form_summary' name='articleSummary' type='textarea'>" . $row['summary'] . "</textarea><br>

                            <label for='articleMain'>Article content:</label><br>
                            <textarea class='form_main' name='articleMain' type='textarea'>" . $row['text'] . "</textarea><br>

                            <label for='articleCategories'>Choose category:</label>";

                            if ($row['category'] == 'formula1') {
                                echo "<select class='form_categories' name='articleCategories'>
                                        <option value='formula1' selected>Formula 1</option>
                                        <option value='wrc'>WRC</option>
                                    </select><br>";
                            } else if ($row['category'] == 'wrc') {
                                echo "<select class='form_categories' name='articleCategories'>
                                        <option value='formula1' selected>Formula 1</option>
                                        <option value='wrc' selected>WRC</option>
                                    </select><br>";
                            }

                            echo "
                            <label for='articleImage'>Add image:</label>
                            <input class='form_image' name='articleImage' type='file' accept='image/jpeg, image/png'><br>

                            <label for='articleArchive'>Show article on website:</label>";
                            if ($row['archive'] == 0) {
                                echo "<input class='form_checkbox' name='articleArchive' type='checkbox' checked> Yes<br>";
                            } else {
                                echo "<input class='form_checkbox' name='articleArchive' type='checkbox'> Yes<br>";
                            }
                            
                    echo "<div class='form_submit_wrapper'>
                            <button type='reset' value='reset' name='resetButton' class='form_reset form_submit'>Reset to default</button>
                            <button type='submit' value='update' name='updateButton' class='form_update form_submit'>Update article</button>
                            <button type='submit' value='delete' name='deleteButton' class='form_delete form_submit'>Delete article</button>
                            </div><br>
                        </form>";
                    }
                } else {
                    echo "<br>Article with ID = $articleId doesent exist.<br>";
                }

                // Update button function
                if (isset($_POST['updateButton'])) {
                    $articleImage = $_FILES['articleImage']['name'];
                    
                    if (isset($_POST['articleArchive'])) {
                        $archive = 0;
                    } else {
                        $archive = 1;
                    }

                    $query = "UPDATE article
                        SET title ='" . $_POST['articleHeader'] . "',
                        summary ='" . $_POST['articleSummary'] . "',
                        text ='" . $_POST['articleMain'] . "',
                        picture='" . $articleImage . "',
                        category ='" . $_POST['articleCategories'] . "',
                        archive = $archive
                    WHERE id = $articleId";

                    $result = mysqli_query($dbc, $query);

                    if($result) {
                        echo "<br>Article was successfully updated!<br>";
                    } else {
                        echo "<br>Error updating an article!<br>";
                    }
                }

                if (isset($_POST['deleteButton'])) {
                    $query = "DELETE FROM article
                                WHERE id = $articleId";

                    $result = mysqli_query($dbc, $query);

                    if($result) {
                        echo "<br>Article was successfully deleted!<br>";
                    }  else {
                        echo "<br>Error deleting an article!<br>";
                    }
                }

            ?>
       </section>
    </main>

    <footer class="footer__wrapper">
        <p class="footer_content">News from motorsport 2022 | © competitiongp.com | Administration</p>
    </footer>
</body>
</html>