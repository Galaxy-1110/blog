
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | <?php echo $title; ?></title>
    <link rel="icon" href="./images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <link rel="stylesheet" href="./styles/<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>.css">
    <link rel="stylesheet" href="./styles/nav.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/styles/default.min.css">
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/highlight.min.js"></script>

    <!-- and it's easy to individually load additional languages -->
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/languages/go.min.js"></script>
</head>
<body>
<nav>
    <a href="./"><img src="./images/logo2.png" id="logo" /></a>
    <div class="nav-items">
        <a href="./blog.php">Blogs</a>
        <a href="./create.php">Create</a>
        <?php
        include_once("./components/isloggedin.php");
        $user = isloggedin();
        if ($user->status) {
            echo "<a href='./destroy.php'>Logout</a>";
        } else {
            echo "<a href='./login.php'>Login</a>";
        }


        ?>
    </div>
</nav>