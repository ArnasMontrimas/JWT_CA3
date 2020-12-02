<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>    
    <main class="container mx-auto">
        <div class="h-screen-40 flex flex-col items-center justify-center">
            <header>
                <h1 class="text-3xl font-medium p-6 m-6">
                    Welcome to service 2
                    <br>
                    <span class="text-center w-full block text-lg p-1 italic text-gray-500">Search Games By Name</span>
                </h1>
                <div>
                    <!-- TODO::Add some example games for the lecturer to search! -->
                </div>
            </header>

            <section class="flex flex-col">
                <div class="p-2">
                    <label for="name">Game Name</label>
                    <input type="text" name="name" placholder="Title..." required>
                </div>
                <button class="transition duration-500 ease-in-out bg-gray-200 rounded-t hover:bg-blue-900 hover:text-white cursor-pointer px-6 py-1 mt-2">
                    <a onclick="executeService1()">Execute Service</a>
                    <!-- TODO Your option for adding more subscribed days would be using the database to persist that time where else would you store it? -->
                    <!-- TODO Decide if service functions will be all in one file or separet files service1, service2 etcc -->
                </button>
            </section>
        </div>
        <section class="w-full overflow-x-auto py-6 webkit-box" id="service1">
        </section>
    </main>
</body>