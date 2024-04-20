
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Page A') }}
        </h2>
    </x-slot>
    <div class="ml-4">
        <a @class(['disabled-link' => !$user->is_active]) id="link"
           href="{{ !$user->is_active ? '#' : $user->link_page_a }}"
           class=" text-success transition duration-150 ease-in-out hover:text-success-600 focus:text-success-600 active:text-success-700 dark:text-gray-200 leading-tight">
            Link Page A ({{ $user->link_page_a ?? '' }})
        </a>

        <div class="row grid gap-4 grid-cols-2 grid-rows-1">
            <div class="col">
                <button id="button-generate"
                        class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Generate
                </button>
            </div>
            <div class="col ml-3">
                <button id="button-deactivate"
                        type="submit"
                        class="deactivate-button bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Deactivate
                </button>
            </div>
        </div>

        <div class="grid gap-4 grid-cols-2 grid-rows-1 pt-5">
            <div>
                <button id="button-lucky"
                        class="common-button bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Imfeelinglucky
                </button>
                <div class="lucky"></div>
            </div>
            <div class="ml-3">
                <button id="button-history"
                        class="common-button bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    History
                </button>
                <div class="history"></div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
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
</script>

