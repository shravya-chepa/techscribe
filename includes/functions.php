<?php

require('config/db.php');

function fetchNews($conn)
{
    $request = $conn->prepare("SELECT articleId,a_title,a_content,a_category,a_author,a_postDate FROM articles ORDER BY a_postDate DESC, postTime DESC");
    return $request->execute() ? $request->fetchAll() : false;
}

function fetchArticlesFrom($conn, $category)
{
    if (!isset($category) || empty($category)) {
        return;
    }
    $request = $conn->prepare("SELECT articleId,a_title,a_content,a_category,a_author,a_postDate FROM articles WHERE a_category = ? ORDER BY a_postDate DESC, postTime DESC");
    return $request->execute(array($category)) ? $request->fetchAll() : false;
}

function getAnArticle($articleId, $conn)
{
    $request = $conn->prepare("SELECT articleId,a_title,a_content,a_category,a_author,a_postDate FROM articles WHERE articleId = ? ");
    return $request->execute(array($articleId)) ? $request->fetchAll() : false;
}

function getDifferentArticles($differ_id, $conn)
{
    $request = $conn->prepare("SELECT articleId,a_title,a_content,a_category,a_author,a_postDate FROM articles WHERE articleId != ? ");
    return $request->execute(array($differ_id)) ? $request->fetchAll() : false;
}

function createAcc($username, $email, $password, $create_datetime, $conn)
{
    $request = $conn->prepare("INSERT INTO `users`(username,password,email,joinDate) values ('$username','" . md5($password) . "', '$email','$create_datetime')");
    return $request->execute() ?: false;
}

function loginUser($username, $password, $conn)
{
    $request = $conn->prepare("SELECT * from `users` WHERE username='$username' AND password='" . md5($password) . "'");
    return $request->execute() ? $request->rowCount() : 0;
}

function getShortContent($Content, $len)
{
    if (strlen($Content) > $len) {
        return substr($Content, 0, $len) . "...";
    } else return $Content;
}
