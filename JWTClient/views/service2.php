<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>    
    <main>
        <h1>Welcome to service 2 page</h1>
        <form action="index.php?action=execute_service2" method="POST">
            <label for="">Game Name</label>
            <input type="text" name="name" id="name" required>
            <input type="submit" value="search">
        </form>
    </main>
</body>