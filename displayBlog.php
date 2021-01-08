<?php require __DIR__ . '../includes/functions.php' ?>
<html>

<head>
    <title>Welcome to news channel</title>
    <link rel="stylesheet" type="text/css" href="design/style.css">
</head>

<body>
    <div class="container">
        <div class="news-box">

            <div class="news">
                <?php
                // get the database handler
                $dbh = connect_to_db(); // function created in dbconnect, remember?

                $id_article = (int)$_GET['newsid'];

                if (!empty($id_article) && $id_article > 0) {
                    // Fecth news
                    $article = getAnArticle($id_article, $dbh);
                    $article = $article[0];
                } else {
                    $article = false;
                    echo "<strong>Wrong article!</strong>";
                }

                $other_articles = getDifferentArticles($id_article, $dbh);

                ?>

                <?php if ($article && !empty($article)) : ?>

                    <h2><?= stripslashes($article->a_title) ?></h2>
                    <span>published on <?= $article->a_postDate ?> by <?= stripslashes($article->a_author) ?></span>
                    <div>
                        <?= stripslashes($article->a_content) ?>
                    </div>
                <?php else : ?>

                <?php endif ?>
            </div>

            <hr>
            <h1>Related articles</h1>
            <div class="similar-posts">
                <?php if ($other_articles && !empty($other_articles)) : ?>

                    <?php foreach ($other_articles as $key => $article) : ?>
                        <h2><a href="displayBlog.php?newsid=<?= $article->articleId ?>"><?= stripslashes($article->a_title) ?></a></h2>
                        <p><?= stripslashes($article->a_content) ?></p>
                        <span>published on <?= $article->a_postDate ?> by <?= stripslashes($article->a_author) ?></span>
                    <?php endforeach ?>

                <?php endif ?>

            </div>

        </div>

        <div class="footer">
        </div>

    </div>
</body>

</html>