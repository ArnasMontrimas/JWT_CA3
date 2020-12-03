<body>
    <header>
        <?php require_once "../views/includes/nav.html"; ?>
    </header>    
    <main class="container mx-auto">
        <div class="h-screen-40 flex flex-col items-center justify-center">
            <header>
                <h1 class="text-3xl font-medium p-6 m-6">
                    Welcome to service 1
                    <br>
                    <span class="text-center w-full block text-lg p-1 italic text-gray-500">Display all games</span>
                </h1>
            </header>

            <section>
                <button class="transition duration-500 ease-in-out bg-gray-200 rounded-t hover:bg-blue-900 hover:text-white cursor-pointer px-6 py-1 mt-2">
                    <a onclick="executeService1()">Execute Service</a>
                </button>
            </section>
        </div>
        <section class="w-full overflow-x-auto py-6 webkit-box" id="service">
        </section>
    </main>
</body>
