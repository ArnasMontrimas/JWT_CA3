 <body>
    <main>
        <div class="container">
            <div class="register-form-container">
                <header>
                    <h1>Register Form</h1>
                    <!-- 
                        Display any present errors
                    -->
                    <?php if(isset($_SESSION['error'])) { ?> 
                        <div>
                            <h4><?php echo $_SESSION['error'] ?></h4>
                        </div>
                        <!-- 
                            Remove error after its displayed this prevents the error from being displayed again when page is refreshed
                         -->
                        <?php unset($_SESSION['error']); ?>
                    <?php }; ?>
                </header>
                <form action="../model/user/register.php" method="POST">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" maxlength="30" reqiured>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <br>
                    <label for="password_confirm">Password Confirm</label>
                    <input type="password" name="password_confirm" id="password_confirm" required>
                    <br>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                    <br>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </main>
</body>