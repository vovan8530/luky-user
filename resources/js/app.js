import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



//Click button History
document.getElementById('button-history')?.addEventListener('click', (e) => {
    e.preventDefault();

    const divHistory = document.querySelector('.history');
    // Remove unnecessary clearing of history

    axios.get("/user/{user}/history")
        .then((response) => {
            // Clear history before appending new data
            divHistory.innerHTML = "";

            // Create column labels
            const divRowLuckyLabel = document.createElement('div');
            divRowLuckyLabel.className = "row-label grid gap-4 grid-cols-2 grid-rows-1";
            divRowLuckyLabel.innerHTML = `
                <div class="num ml-3 dark:text-gray-200 leading-tight">Num</div>
                <div class="num ml-3 dark:text-gray-200 leading-tight">Win or Lose</div>
            `;
            divHistory.appendChild(divRowLuckyLabel);

            // Append history data
            response.data.forEach((item) => {
                const divRowHistory = document.createElement('div');
                divRowHistory.className = "row-history grid gap-4 grid-cols-2 grid-rows-1";
                divRowHistory.innerHTML = `
                    <div class="lucky-number ml-3 dark:text-gray-200 leading-tight">${item['lucky_number']}</div>
                    <div class="winn-number ml-4 dark:text-gray-200 leading-tight">${item['winning_number']}</div>
                `;
                divHistory.appendChild(divRowHistory);
            });
        })
        .catch((error) => {
            console.error('Error fetching user history:', error);
            // Handle error: Display error message to the user
        });
});


//Click button Imfeelinglucky
document.getElementById('button-lucky')?.addEventListener('click', (e) => {
    e.preventDefault();

    const divLucky = document.querySelector('.lucky');
    divLucky.innerHTML = "";

    axios.get("/user/{user}/lucky")
        .then((response) => {
            const {lucky_number, winning_number} = response.data;

            const divRowLucky = document.createElement('div');
            divRowLucky.className = "row-luck grid gap-4 grid-cols-2 grid-rows-1";

            const divRowLuckyLabel = document.createElement('div');
            divRowLuckyLabel.className = "row-label grid gap-4 grid-cols-2 grid-rows-1";

            const newDivNum = document.createElement('div');
            newDivNum.className = "num  ml-3 dark:text-gray-200 leading-tight";
            newDivNum.textContent = "Num";

            const newDivWin = document.createElement('div');
            newDivWin.className = "num ml-3 dark:text-gray-200 leading-tight";
            newDivWin.textContent = winning_number !== 0 ? "Win" : "Lose";

            const newDivLucky = document.createElement('div');
            newDivLucky.className = "lucky-number ml-3 dark:text-gray-200 leading-tight";
            newDivLucky.textContent = lucky_number;

            const newDivWinn = document.createElement('div');
            newDivWinn.className = "winn-number ml-4 dark:text-gray-200 leading-tight";
            newDivWinn.textContent = winning_number;

            divRowLuckyLabel.appendChild(newDivNum);
            divRowLuckyLabel.appendChild(newDivWin);
            divLucky.appendChild(divRowLuckyLabel);

            divRowLucky.appendChild(newDivLucky);
            divRowLucky.appendChild(newDivWinn);
            divLucky.appendChild(divRowLucky);
        })
        .catch((error) => {
            console.error('Error fetching lucky number:', error);
            // Handle error: Display error message to the user
        });
});

//Click button Generate
const button = document.getElementById('button-generate');
const link = document.querySelector('#link');

button?.addEventListener('click', async (e) => {
    e.preventDefault();

    try {
        const response = await axios.get("/user/{user}/update-link");
        const { link_page_a } = response.data;

        link.textContent = link_page_a;
        link.href = link_page_a;
        link.classList.remove('disabled-link');

    } catch (error) {
        console.error('Error fetching new link:', error);
        // Handle error: Display error message to the user
    }
});

//Click button Deactivate
const buttonDeactivate = document.getElementById('button-deactivate');
const linkA = document.querySelector('#link');

buttonDeactivate?.addEventListener('click', async (e) => {
    e.preventDefault();

    try {
        const response = await axios.get("/user/{user}/deactivate-link");

        if (response.data) {
            linkA.href = '#';
            linkA.classList.add('disabled-link');
        }

    } catch (error) {
        console.error('Error deactivating the link:', error);
        // Handle error: Display error message to the user
    }
});
