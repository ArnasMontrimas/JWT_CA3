 <body>
    <main>
        <div class="container">
            <div class="register-form-container">
                <header>
                    <h1>Registration Form</h1>
                    <!-- 
                        Display any present errors
                    -->
                    <?php if(isset($_SESSION['error'])) { ?> 
                        <div class="alert-message">
                            <h4><?php echo $_SESSION['error'] ?></h4>
                        </div>
                        <!-- 
                            Remove error after its displayed this prevents the error from being displayed again when page is refreshed
                         -->
                        <?php unset($_SESSION['error']); ?>
                    <?php }; ?>
                </header>
                <form action="../model/user/register.php" method="POST">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" maxlength="30" reqiured>
                    </div>                    
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div>
                        <label for="password_confirm">Password Confirm</label>
                        <input type="password" name="password_confirm" id="password_confirm" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div>
                        <input type="submit" value="Register">
                    </div>
                </form>
                <div><!-- Wrapper Div -->
                    <a href="index.php">Login here</a>
                </div>
            </div>
        </div>
    </main>
</body>