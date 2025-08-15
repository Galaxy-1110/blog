<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | <?php echo $title; ?></title>
    <!-- ICON -->
    <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/app-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/favicon/app-icon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">
    <!-- STYLES -->
    <link rel="stylesheet" href="styles/<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>.css">
    <link rel="stylesheet" href="styles/defaults.css" />
    <link rel="stylesheet" href="styles/popup.css" />
    <link rel="stylesheet" href="styles/nav.css" />
    <!-- SCRIPTS -->
     <script src="./scripts/popup.js"></script>
    <!-- GSAP ANIMATION -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <!-- EASYMDE  -->
    <?php
        if(isset($easyMDE) && $easyMDE)
            echo '
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
            <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/styles/default.min.css">
            <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/highlight.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.9.0/build/languages/go.min.js"></script>
            '
    ?>

    <!-- Font Import-->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>

<!-- NAVIGATION BAR -->
<nav>
    <a href="./"><img src="./images/logo_full.webp" id="logo" width="80" height="120" /></a>
    <div class="nav-items">
        <a href="./blog.php" class="nav-item">Blogs</a>
        <a href="./create.php" class="nav-item">Create</a>
        <?php
        include_once("./components/isloggedin.php");
            $user = isloggedin();
            if ($user->status) {
                echo "<a href='./destroy.php' class='nav-item'>Logout</a>";
            } else {
                echo "<a href='./login.php' class='nav-item'>Login</a>";
            }
        ?>
    </div>
</nav>

<!-- CUSTOM CURSOR -->
<span id="cursor"></span>
<!-- CURSOR ANIMATIONS -->
<script type="module">
    import { isMobileUser } from "./scripts/isMobileUser.js";
    import { debounce } from "./scripts/debounce.js";
    import { setHovering, getHovering } from "./components/cursorevents.js";
        
    let disableCursor = false;
    function initCursor() {
        if(disableCursor) return;
        gsap.set('#cursor', {
            xPercent: -50, 
            yPercent: -50, 
            opacity: 0, 
            width: 20, 
            height: 20, 
            borderRadius: '100%', 
        });
            
        let cursor = document.getElementById('cursor');
        
        const savedX = localStorage.getItem('cursorX'),
            savedY = localStorage.getItem('cursorY');
        
        if(savedX && savedY) {
            gsap.set(cursor, {
                x: parseFloat(savedX),
                y: parseFloat(savedY),
                opacity: 1
            })
        }
            
        var mouseX, mouseY;
        
        window.addEventListener("mousemove", (e) => {
            if(!getHovering()) {
                mouseX = e.clientX;
                mouseY = e.clientY;
        
                gsap.to(cursor, { 
                    x: mouseX, 
                    y: mouseY, 
                    opacity: 1, 
                    duration: 0, 
                    overwrite: "auto"
                });
                saveCursorPosition(mouseX, mouseY);
            }
        }, {passive: true});
        
        const navitems = document.querySelectorAll('.nav-item');
        navitems.forEach(item => {
            let timeout;

            item.addEventListener('mouseenter', () => {
                timeout = setTimeout(() => {
                    setHovering(true);
                    const rect = item.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;
        
                    gsap.to(cursor, {
                        width: rect.width + 16,
                        height: rect.height + 12,
                        borderRadius: '12px',
                        x: centerX,
                        y: centerY,
                        duration: 0.3, 
                        overwrite: "auto"
                    });
                }, 15)
            });
        
            item.addEventListener('mouseleave', () => {
                clearTimeout(timeout);
                setHovering(false);
        
                gsap.to(cursor, {
                    width: '20px',
                    height: '20px',
                    borderRadius: '100%',
                    ease: "power1.out",
                    duration: 0.1,
                    overwrite: "auto"
                })
            })
         })
    }

    const saveCursorPosition = debounce((x, y) => {
        localStorage.setItem('cursorX', x);
        localStorage.setItem('cursorY', y);
    }, 100)
    window.addEventListener('load', initCursor);

    window.addEventListener('resize', () => {
        let cursor = document.getElementById('cursor');
    })
</script>

