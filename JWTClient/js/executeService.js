/**
 * Get html container to which we will insert html
 */
const container = document.querySelector("#service");

/**
 * Set an empty games array, here we store response of games from the server
 */
let games = [];

/**
 * this function takes in data parameter which will be a response from the server and displays the response in html 
 * @param {JSON} data a json object
 */
let printGamesHtml = (data) => {
    //Loop through the object and display the values formated in html
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

/**
 * This function will print a message from the server
 * @param {String} message the message returned from the server 
 */
let printMessageHtml = (message) => {
    //Format message of time left to wait
    let hours = message.slice(0, 2);
    let minutes = message.slice(3, 5);
    container.innerHTML = `
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

/**
 * This function will print a message from the server
 * @param {String} message the message returned from the server 
 */
let printNothingFoundMessageHtml = (message) => {
    container.innerHTML = `
    <div class="w-full text-center">
        <h1 class="text-xl font-medium p-4 text-red-700">
            ${message}
        </h1>
    </div>
    `
}

/**
 * This function will print a message from the server
 * @param {String} message the message returned from the server 
 */
let printRestrictionMessageHtml = (message) => {
    container.innerHTML = `
    <div class="w-full text-center">
        <h1 class="text-xl font-medium p-4 text-red-700">
            ${message}
        </h1>
    </div>
    `
}

/**
 * This function will send a get request to the server and proccess the response
 */
let executeService1 = () => {
    fetch("index.php?action=execute_service1")
        .then(res => res.json())
        .then(data => {
            switch(data['games']) {
                case null:
                    container.innerHTML = "";
                    printMessageHtml(data['message']);
                    break;
                case undefined:
                    printRestrictionMessageHtml(data['message']);
                    break;
                default:
                    container.innerHTML = "";
                    games = data;
                    printGamesHtml(JSON.parse(games['games']));
            }
        })
        .catch(err => console.log(err));
}

/**
 * This function will send a post request to the server and proccess the response
 */
let executeService2 = () => {
    let name = document.querySelector("input[name='name']").value;

    let formData = new FormData();
    formData.append("name", name);

    fetch("index.php?action=execute_service2", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        switch(data['games']) {
            case null:
                container.innerHTML = "";
                printRestrictionMessageHtml(data['message']);
                break;
            case undefined:
                printRestrictionMessageHtml(data['message']);
                break;
            case "[]":
                printNothingFoundMessageHtml("Nothing was found try again");
                break;
            default:
                container.innerHTML = "";
                games = data;
                printGamesHtml(JSON.parse(games['games']));
        }
        
    })
    .catch(err => console.log(err));
}

/**
 * This function will send a post request to the server and proccess the response
 */
let executeService3 = () => {
    let genre = document.querySelector("input[name='genre']").value;
    let platform = document.querySelector("input[name='platform']").value;
    
    let formData = new FormData();
    formData.append("genre", genre);
    formData.append("platform", platform);

    fetch("index.php?action=execute_service3", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        switch(data['games']) {
            case null:
                container.innerHTML = "";
                printRestrictionMessageHtml(data['message']);
                break;
            case undefined:
                printRestrictionMessageHtml(data['message']);
                break;
            case "[]":
                printNothingFoundMessageHtml("Nothing was found try again");
                break;
            default:
                container.innerHTML = "";
                games = data;
                printGamesHtml(JSON.parse(games['games']));
        }
    })
    .catch(err => console.log(err));
}