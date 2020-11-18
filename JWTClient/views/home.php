<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>
    <main>
        <header>
            <!-- 
                Display message on successful registration
            -->
            <?php if(isset($_SESSION['success'])) { ?> 
                <h1><?php echo $_SESSION['success'] ?></h1>
                <!-- 
                    Remove message after its displayed this prevents the message from being displayed again when page is refreshed
                -->
                <?php unset($_SESSION['success']); ?>
            <?php }; ?>
        </header>
        <section>
            <h4>Request API</h4>
        </section>
    </main>
</body>