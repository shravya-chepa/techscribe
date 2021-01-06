<!DOCTYPE html>
<html lang="en">

<?php

include("includes/functions.php");
$category = $_GET["category"];
$dbh = connect_to_db();
$news = fetchArticlesFrom($dbh, $category);

function shortArticles($news)
{
    if ($news && !empty($news)) :
        foreach ($news as $key => $article) : ?>
            <div class="shortnews">
                <h5>
                    <a href="displayBlog.php?newsid=<?= $article->articleId ?>">
                        <?= $article->a_title ?>
                    </a>
                    <h3>
                        <?= getShortContent($article->a_content, 70) ?>
                    </h3>
                    <span> By <?= $article->a_author ?> | <?= $article->a_category ?> | <?= $article->a_postDate ?> </span>
                </h5>
            </div>
<?php
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
            <?php shortArticles($news); ?>
        </main>
</body>

</html>