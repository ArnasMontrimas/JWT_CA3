<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>
    <main>
        <?php if(isset($_SESSION['success'])) { ?> 
            <header>
                <h1><?php echo $_SESSION['success'] ?></h1>
            </header>
            <?php unset($_SESSION['success']); ?>
        <?php } 
            elseif(isset($_SESSION['error'])) {
        ?>
            <header>
                <h1><?php echo $_SESSION['error'] ?></h1>
            </header>
            <?php unset($_SESSION['error']) ?>
        <?php }; ?>
        
        <section>
            <div class="container">
                <div class="request-api-key-container">
                    <header>
                        <h3>
                            Select/Change services package
                            <br>
                            <?php
                            if(isset($_SESSION['api_key'])) {
                                echo "Your Services Package is: " . ucfirst($_SESSION['user']['type']);
                            }
                            else {
                                echo "You need to purchase a plan to use the services";
                            }
                            ?>
                        </h3>
                    </header>
                    <div>
                        <h5>Select Your Subscription Plan</h5>
                        <form action="index.php?action=request_api_key" method="POST">
                            <label for="free">Free</label>
                            <input type="radio" id="free" name="membership" value="free" required>
                            <label for="premium">Premium</label>
                            <input type="radio" id="premium" name="membership" value="premium" required>
                            <input type="submit" value="Buy">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>