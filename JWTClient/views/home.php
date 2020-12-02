<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>
    <main>
        <section class="container mx-auto max-w-3xl">
            <div class="h-screen-60 flex flex-col justify-center items-center"">
                <div>
                    <header>
                        <h1 class="text-2xl font-medium mb-6 pb-6">Select/Change services package</h1>
                        <?php if(isset($_SESSION['success'])) { ?> 
                            <h1 class="mb-3 text-green-700 font-bold text-lg"><?php echo $_SESSION['success'] ?></h1>
                        <?php unset($_SESSION['success']); ?>
                        <?php } 
                        elseif(isset($_SESSION['error'])) {
                        ?>
                        <h1 class="mb-3 text-red-700 font-bold text-lg"><?php echo $_SESSION['error'] ?></h1>
                        <?php unset($_SESSION['error']) ?>
                        <?php }; ?>
                        <?php
                        if(isset($_SESSION['api_key'])) { 
                        ?>
                            <h4 class="text-lg font-medium mb-3"><?php echo "Your Services Package is: " . ucfirst($_SESSION['user']['type']) ?></h4>
                        <?php }
                        else { 
                        ?>
                            <h4 class="text-lg font-medium mb-3"><?php echo "You need to purchase a plan to use the services" ?><h4>
                        <?php }; ?>
                    </header>
                    <div>
                        <h5 class="mb-1">Select Your Subscription Plan</h5>
                        <form action="index.php?action=request_api_key" id="packageForm" method="POST">
                            <label for="free">Free</label>
                            <input type="radio" id="free" name="membership" value="free" required>
                            <label for="premium">Premium</label>
                            <input type="radio" id="premium" name="membership" value="premium" required>
                            <br>
                            <input onclick="showAlert(<?php echo $_SESSION['user']['type'] ?>)" class="transition duration-500 ease-in-out rounded-t hover:bg-blue-900 hover:text-white cursor-pointer px-6 py-1 mt-2" type="submit" value="Confirm">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>