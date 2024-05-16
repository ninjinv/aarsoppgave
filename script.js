// const openBtn = document.getElementById('openProfile')
// const closeBtn = document.getElementById('closeModal')
// const modal = document.getElementById('modal')
 
// openBtn.addEventListener("click", () => {
//     modal.classlist.add("open");
// });

// closeBtn.addEventListener("click", () => {
//     modal.classlist.remove("open");
// });

document.addEventListener('DOMContentLoaded', function () {
    // Hent alle accordion-header-elementer
    const accordionButtons = document.querySelectorAll('.accordion-button');

    // Legg til klikk-hendelseslytter på hvert accordion-header-element
    accordionButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Finn det tilhørende collapse-elementet
            const answer = button.parentElement.nextElementSibling;

            console.log('Button:', button);
            console.log('Answer:', answer);

            // Bytt stil for å vise/skjule svar-elementet
            if (answer.style.display === 'inline-block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'inline-block';
            }
        });
    });
});


const vnData = 'VNData.json';

// get html elements simple stuff yadayada
function getElements() {
    return {
        sprite: document.querySelector('#spritebox img'),
        name: document.querySelector('#namebox span'),
        text: document.querySelector('#textbox p'),
        options: document.querySelector('#optionsbox'),
        
    };
}

// funksjon som oppdaterer
// Function to update elements on the page
function updateElements(data) {
    const { sprite, name, text, options } = getElements();

    console.log("data.options:", data.options); // check if options data is corrcect 

    sprite.src = data.spriteSrc;
    name.innerText = data.name;
    text.innerText = data.text;

    if (options) {
        options.innerHTML = '';
        if (data.options && Object.keys(data.options).length) { // checks if there are data.options exist (on that page), convert into array
            Object.keys(data.options).forEach(optionKey => { // return array w butons
                console.log("creat button for:", optionKey); // console to check button create ting dong
                const button = document.createElement('button');
                button.textContent = optionKey; // sets buttoncontent to the optioncontent privided in my data
                button.onclick = () => {
                    currentPageIndex = Object.keys(jsonData.Scene1.PAGES).indexOf(data.options[optionKey]);
                    showPage();
                };
                options.appendChild(button);
            });
        }
    } else {
        console.error('Options box not found in the DOM.');
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

    typeWriter(currentPage.PageText);
        // document.getElementById('mainbox').style.backgroundImage = `url(${jsonData.Scene1.Background})`;
}


// options
// option select




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
    if (currentPage.Options) {
        return; // if options, no go to next page 
    }

    if (currentPage.NextPage !== "End") { // not end, continue.
        currentPageIndex++; // next
        showPage(); // update pg
    }
});

fetchData(); // tihi fetchdata som da tar data også etter det awaiter og gjør om jsondata til den dataen i json filen