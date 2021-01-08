<!DOCTYPE html>
<html lang="en">

<?php

include("includes/functions.php");
$dbh = connect_to_db();
$news = fetchNews($dbh);

function mainArticles($news)
{
    if ($news && !empty($news)) :
        foreach ($news as $key => $article) : if ($key < 4) { ?>
                <div class="singleBlog">
                    <a href="displayBlog.php?newsid=<?= $article->articleId ?>">
                        <img src="assets/images/3.jpg" alt="">
                        <div class="blogContent">
                            <h3>
                                <?= stripslashes($article->a_title) ?><span>
                                    <?= $article->a_category ?>
                                </span>
                            </h3>
                            <h3>
                                <?= getShortContent($article->a_content, 30) ?>
                            </h3>
                            <p>By <?= $article->a_author ?> | <?= $article->a_postDate ?> </p>
                            <a href="displayBlog.php?newsid=<?= $article->articleId ?>" class="btn">Read More</a>
                        </div>
                    </a>
                </div>
            <?php }
        endforeach;
    endif;
}

function shortArticles($news)
{
    if ($news && !empty($news)) :
        foreach ($news as $key => $article) : if ($key >= 4) { ?>
                <div class="shortnews">
                    <h5>
                        <a href="displayBlog.php?newsid=<?= $article->articleId ?>">
                            <?= $article->a_title ?>
                        </a>
                        <h3>
                            <?= getShortContent($article->a_content, 70) ?>
                        </h3>
                        <span> By <?= $article->a_author ?> | <?= $article->a_postDate ?> </span>
                    </h5>
                </div>
<?php }
        endforeach;
    endif;
}

?>


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TechScribe</title>
    <link rel="stylesheet" href="css/homepage_style.css" />
</head>

<body>
    <div class="container">
        <div class="navig">
            <div class="left">
                <div class="link">
                    <a href="index.php">TechScribe</a>
                </div>
                <div class="link">
                    <a href="categoryPage.php?category=Gaming">Gaming</a>
                </div>
                <div class="link">
                    <a href="categoryPage.php?category=Tech">Tech</a>
                </div>
            </div>
            <div class="right">
                <div class="link-2">
                    <?php
                    include("auth/auth_session.php");
                    if (!isset($_SESSION["username"])) { ?>
                        <a href="login.php">Login</a>
                    <?php } else { ?>
                        <div class="usertext">
                            <h3>Welcome, <?php echo "{$_SESSION["username"]}"; ?> <a href="auth/logout.php">Logout</a></h3>
                        <?php }
                        ?>
                        </div>
                </div>
            </div>
        </div>
        <main>
            <?php mainArticles($news); ?>
        </main>
        <?php shortArticles($news); ?>
</body>

</html>