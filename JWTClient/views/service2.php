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
                <div class="p-1 mb-4 text-center">
                    <ul class="flex flex-col items-around">
                        <div>
                            <span class="font-medium">Game Names</span>
                        </div>
                        <div class="flex justify-around">
                            <li class="py-1 italic text-gray-500 text-medium">
                                Bloodborne
                            </li>
                            <li class="py-1 italic text-gray-500 text-medium">
                                Cuphead
                            </li>
                            <li class="py-1 italic text-gray-500 text-medium">
                                Titanfall
                            </li>
                        </div>
                    </ul>
                </div>
            </header>

            <section class="flex flex-col">
                <div class="p-2">
                    <label class="px-3" for="name">Game Name</label>
                    <input class="transition duration-500 ease-in-out focus:border-blue-700 focus:outline-none border-b-2 border-blue-400" type="text" name="name" required>
                </div>
                <button class="transition duration-500 ease-in-out bg-gray-200 rounded-t hover:bg-blue-900 hover:text-white cursor-pointer px-6 py-1 mt-2">
                    <a onclick="executeService2()">Execute Service</a>
                </button>
            </section>
        </div>
        <section class="w-full overflow-x-auto py-6 webkit-box" id="service">
        </section>
    </main>
</body>