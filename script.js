// const openBtn = document.getElementById('openProfile')
// const closeBtn = document.getElementById('closeModal')
// const modal = document.getElementById('modal')
 
// openBtn.addEventListener("click", () => {
//     modal.classlist.add("open");
// });

// closeBtn.addEventListener("click", () => {
//     modal.classlist.remove("open");
// });


const vnData = 'VNData.json';

// get html elements
function getElements() {
    return {
        sprite: document.querySelector('#spritebox img'),
        name: document.querySelector('#namebox span'),
        text: document.querySelector('#textbox p'),
        options: document.querySelector('#optionsbox button'),
        
    };
}

// funksjon som oppdaterer
function updateElements(data) {
    const { sprite, name, text, options } = getElements();

    sprite.src = data.spriteSrc;
    name.innerText = data.name;
    text.innerText = data.text;

    options.innerHTML = '';
    if (data.options && data.options.length) {
        data.options.forEach(option => {
            const button = document.createElement('button');
            button.textContent = option.text;
            button.onclick = option.callback;
            options.appendChild(button);
        });
    }
}


let jsonData, currentPageIndex = 0; // jsondata = 0 and page number 0 meaning page 0 beginning

async function fetchData() { // async like multitask
    const response = await fetch(vnData); // have to wait for this
    jsonData = await response.json(); // then this
    showPage(); // and so boom
}

// display
function showPage() {
    const pageKeys = Object.keys(jsonData.Scene1.PAGES); // object.keys: take from jsondata scene1 pages (so it takes the pages like Page0 )
    const currentPageKey = pageKeys[currentPageIndex]; // pagekeys[currentpageindex], for current pagekey (current page)
    const currentPage = jsonData.Scene1.PAGES[currentPageKey]; // currentpage is then the pages currentpagekey (page number from my json)

    updateElements({
        spriteSrc: jsonData.Characters[currentPage.Character][currentPage.Sprite],
        name: currentPage.Character, //update
        text: currentPage.PageText, //update
        options: currentPage.Options || [] // either shows them or no options
    });

        // document.getElementById('mainbox').style.backgroundImage = `url(${jsonData.Scene1.Background})`;
}

// options
// option select
function handleOptions(data) {
    
    document.getElementById('optionsbox').innerHTML = "";

    // check if u have any options on that page.
    if (jsonData.Scene1.PAGES[currentPageIndex].hasOwnProperty('Options')) {
        // define thy options :3
        let options = jsonData.Scene1.PAGES[currentPageIndex].Options;

        
        Object.keys(options).forEach(optionKey => {
            // create new button
            const button = document.createElement('button');
            // Schanges text
            button.textContent = optionKey;
            // append  button to optionsbox so it goes in there lol
            document.getElementById('optionsbox').appendChild(button);

            // add eventlistener
            button.addEventListener('click', () => {
             
                currentPageIndex = Object.keys(jsonData.Scene1.PAGES).indexOf(options[optionKey]);
        
                showPage();
            });
        });
    }
}


// //create thy buttons
// function createOptionButtons(options) {
//     const optionsBox = document.getElementById('optionsbox');
//     optionsBox.innerHTML = ''; // clear any other options

//     Object.entries(options).forEach(([text, nextPage]) => {
//         const button = document.createElement('button');
//         button.textContent = text;
//         button.onclick = () => handleOptionSelection(nextPage);
//         optionsBox.appendChild(button);
//     });
// }

document.addEventListener('click', () => {
    const currentPage = jsonData.Scene1.PAGES[Object.keys(jsonData.Scene1.PAGES)[currentPageIndex]];
    if (currentPage.Options || currentPage.NextPage !== "End") { // || means or so if options or next page is not end then go next
        currentPageIndex++; // variable, go next
        showPage(); // show new page
    }
});

fetchData(); // tihi fetchdata som da tar data også etter det awaiter og gjør om jsondata til den dataen i json filen