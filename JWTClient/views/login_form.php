<body>
    <main>
        <div class="container">
            <div class="login-form-container">
                <header>
                    <h1>Welcome Please Login</h1>
                    <!-- 
                        Display any present errors
                    -->
                    <?php if(isset($_SESSION['error'])) { ?> 
                        <div class="alert-message">
                            <h4><?php echo $_SESSION['error'] ?></h4>
                        </div>
                        <!-- 
                            Remove eorro after its displayed this prevents the error from being displayed again when page is refreshed
                         -->
                        <?php unset($_SESSION['error']); ?>
                    <?php }; ?>
                </header>
                <form action="../model/user/login.php" method="POST">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" reqiured>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div>
                        <input type="submit" value="Login">
                    </div>
                </form>
                <div><!-- Wrapper Div -->
                    <a href="index.php?action=register_form">Register here</a>
                </div>
            </div>
        </div>
    </main>
</body>