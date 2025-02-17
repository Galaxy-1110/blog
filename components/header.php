
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | <?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <link rel="stylesheet" href="./styles/<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>.css">
    <link rel="stylesheet" href="./styles/nav.css" />
    <script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
</head>
<body>
<nav>
    <a href="./"><img src="./images/logo2.png" id="logo" /></a>
    <div class="nav-items">
        <a href="./blog.php">Blogs</a>
        <a href="./create.php">Create</a>
    </div>
</nav>