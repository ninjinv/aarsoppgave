document.addEventListener('DOMContentLoaded', function () {
    // Select all accordion buttons
    const accordionButtons = document.querySelectorAll('.accordion-button');

    // Add click event listener to each accordion button
    accordionButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Toggle the 'open' class on the button
            button.classList.toggle('open');

            // Toggle the display of the answer section
            const answer = button.parentElement.nextElementSibling;
            
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', !isExpanded);

            // Log button and answer
            console.log('Button:', button);
            console.log('Answer:', answer);

            if (answer.style.maxHeight) {
                answer.style.maxHeight = null; // Collapse the answer
                answer.classList.remove('show'); // Remove the 'show' class
            } else {
                answer.style.maxHeight = answer.scrollHeight + 'px'; // Expand the answer
                answer.classList.add('show'); // Add the 'show' class
            }
            // Toggle the display of the answer section using classList
            answer.classList.toggle('accordion-collapse-display');
        });
    });

    const vnData = 'VNData.json';

    // Get HTML elements
    function getElements() {
        return {
            sprite: document.querySelector('#spritebox img'),
            name: document.querySelector('#namebox span'),
            text: document.querySelector('#textbox p'),
            options: document.querySelector('#optionsbox'),
        };
    }

    // Update elements on the page
    function updateElements(data) {
        const { sprite, name, text, options } = getElements();

        sprite.src = data.spriteSrc;
        name.innerText = data.name;
        text.innerText = data.text;

        if (options) {
            options.innerHTML = '';
            if (data.options && Object.keys(data.options).length) {
                Object.keys(data.options).forEach(optionKey => {
                    const button = document.createElement('button');
                    button.textContent = optionKey;
                    button.className = "p-2 col-start-1 col-end-3 tile bg-gray-600";
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

    let jsonData, currentPageIndex = 0;

    // Fetch data from JSON file
    async function fetchData() {
        const response = await fetch(vnData);
        jsonData = await response.json();
        
        // Fetch saved page from the database
        fetchProgress();
    }

    // Fetch saved page from the database
    function fetchProgress() {
        fetch('get_progress.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const pageKeys = Object.keys(jsonData.Scene1.PAGES);
                currentPageIndex = pageKeys.indexOf(data.current_page);
                showPage();
            } else {
                console.error('Failed to retrieve progress:', data.message);
                showPage();
            }
        })
        .catch(error => {
            console.error('Error retrieving progress:', error);
            showPage();
        });
    }
    
    // Show current page
    function showPage() {
        const pageKeys = Object.keys(jsonData.Scene1.PAGES);
        const currentPageKey = pageKeys[currentPageIndex];
        const currentPage = jsonData.Scene1.PAGES[currentPageKey];

        updateElements({
            spriteSrc: jsonData.Characters[currentPage.Character][currentPage.Sprite],
            name: currentPage.Character,
            text: currentPage.PageText,
            options: currentPage.Options || []
        });

    }

    function getCurrentPageId() {
        const pageKeys = Object.keys(jsonData.Scene1.PAGES);
        return pageKeys[currentPageIndex];
    }

    // Save progress
    function saveProgress() {
    const currentPageId = getCurrentPageId();
    console.log('Saving progress for page:', currentPageId);

    fetch('save_progress.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            progress: currentPageId
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Progress saved successfully');
        } else {
            console.error('Failed to save progress:', data.message);
        }
    })
    .catch(error => {
        console.error('Error saving progress:', error);
    });
}

    // Listen for click events
    document.addEventListener('click', () => {
        const currentPage = jsonData.Scene1.PAGES[Object.keys(jsonData.Scene1.PAGES)[currentPageIndex]];
        if (currentPage.Options) {
            return; // If options, do not go to next page
        }
    
        if (currentPage.NextPage !== "End") { // Not end, continue
            currentPageIndex++; // Next
            showPage(); // Update page
            saveProgress(); // Save progress when player progresses
        }
    });

    // Fetch data on page load
    fetchData();
});
