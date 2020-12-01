<body>
    <main>
        <div class="container mx-auto">
            <div class="h-screen-80 flex flex-col justify-center items-center">
                <header class="text-center text-2xl font-medium mb-6 p-5">
                    <h1>Welcome Please Login</h1>
                </header>
                <!-- 
                    Display any present errors
                -->
                <?php if(isset($_SESSION['error'])) { ?> 
                    <div class="text-lg text-red-900 font-bold">
                        <h4><?php echo $_SESSION['error'] ?></h4>
                    </div>
                    <!-- 
                        Remove eorro after its displayed this prevents the error from being displayed again when page is refreshed
                    -->
                    <?php unset($_SESSION['error']); ?>
                <?php }; ?>
                <form action="index.php?action=login" method="POST" class="sm:w-80">
                    <div class="flex flex-col p-2">
                        <label for="email" class="mb-1 font-medium">Email</label>
                        <input class="transition duration-500 ease-in-out focus:border-blue-700 focus:outline-none border-b-2 border-blue-400" type="email" name="email" id="email" reqiured>
                    </div>
                    <div class="flex flex-col p-2 font-medium">
                        <label for="password" class="mb-1">Password</label>
                        <input class="transition duration-500 ease-in-out focus:border-blue-700 focus:outline-none border-b-2 border-blue-400" type="password" name="password" id="password" required>
                    </div>
                    <div class="p-2">
                        <input class="p-1 px-5 rounded bg-blue-400 focus:outline-none transition duration-500 ease-in-out hover:bg-blue-700 cursor-pointer" type="submit" value="Login">
                    </div>
                </form>
                <div class="p-2 text-center pt-5 text-lg font-bold"><!-- Wrapper Div -->
                    <a href="index.php?action=register_form" class="transition-all duration-500 ease-in-out text-red-400 hover:text-red-700 transform hover:scale-125 block">Register here</a>
                </div>
            </div>
        </div>
    </main>
</body>