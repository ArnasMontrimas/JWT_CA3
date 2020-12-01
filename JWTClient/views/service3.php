<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>    
    <main>
        <h1>Welcome to service 3 page</h1>
        <form action="index.php?action=execute_service3" method="POST">
            <label for="">Genre</label>
            <input type="text" name="genre" id="genre">
            <br>
            <br>
            <label for="">Platform</label>
            <input type="text" name="platform" id="platform">
            <input type="submit" value="search">
        </form>
    </main>
</body>