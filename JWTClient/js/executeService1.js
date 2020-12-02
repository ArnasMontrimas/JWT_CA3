const container = document.querySelector("#service1");
let games = [];


let printGamesHtml = (data) => {
    Object.values(data).forEach(e => {
        container.innerHTML += `
        <div class="bg-blue-900 text-white border-2 border-gray-900 rounded ring-3 w-11/12 p-4 mx-6 px-6">
            <header class="text-lg">
                <div>
                    <span class="font-medium">Name:</span>
                    <span>&nbsp;${e.name}</span>
                </div>
                <div>
                    <span class="font-medium">Genre:</span>
                    <span>&nbsp;${e.genre}</span>
                </div>
                <div>
                    <span class="font-medium">Platform:</span>
                    <span>&nbsp;${e.platform}</span>
                </div>
                <div>
                    <span class="font-medium">Year:</span>
                    <span>&nbsp;${e.release_year}</span>
                </div>
            </header>
            <span class="block h-2"></span>
            <span class="bg-gray-900 w-full block h-0.5 rounded"></span>
            <span class="block h-2"></span>
            <section>
                <div>
                    <span class="font-medium text-lg">Description</span>
                    <br>
                    <span>
                        ${e.description}
                    </span>
                </div>
            </section>
        </div>
        `
    })
}

let printMessageHtml = (message) => {
    let hours = message.slice(0, 2);
    let minutes = message.slice(3, 5);
    container.innerHTML += `
    <div class="w-full text-center">
        <h1 class="text-xl font-medium p-4 text-red-700">
            You have used the service 10 times today
            <br>
            You may use the service again in: ${hours} hours and ${minutes} minutes
            <br>
            <span class="pt-2 block text-base italic text-gray-500">
                Dont want to wait?
                <br>
                Purchase premium to have unlimited access!
            </span>
        </h1>
    </div>
    `
}

let executeService1 = () => {
    fetch("index.php?action=execute_service1")
        .then(res => res.json())
        .then(data => {
            if(data['games'] === null) {
                printMessageHtml(data['message']);
            }
            else {
                games = data;
                printGamesHtml(JSON.parse(games['games']));
            }
        })
        .catch(err => console.log(err));
}