<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>
    <main>
        <!-- 
            Display message on successful registration
        -->
        <?php if(isset($_SESSION['success'])) { ?> 
            <header>
                <h1><?php echo $_SESSION['success'] ?></h1>
            </header>
            <!-- 
                Remove message after its displayed this prevents the message from being displayed again when page is refreshed
            -->
            <?php unset($_SESSION['success']); ?>
        <?php }; ?>
        <section>
            <div class="container">
                <div class="request-api-key-container">
                    <header>
                        <h3>Request API KEY / Use free services</h3>
                    </header>
                    <div>
                        <h5>Select Your Subscription Plan</h5>
                        <form action="index.php?action=request_api_key" method="POST">
                            <label for="free">Free</label>
                            <input type="radio" id="free" name="membership" value="free" required>
                            <label for="premium">Premium</label>
                            <input type="radio" id="premium" name="membership" value="premium" required>
                            <input type="submit" value="Generate Key">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>