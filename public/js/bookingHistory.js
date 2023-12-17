const cardContainer = document.getElementById('cardContainer');
const API_URL = '/api/bookingHistory';


///////////////////////////////////////// Initial render /////////////////////////////////////////
async function InitialRender() {
    const payload = getCookie('payload');

    if (!payload) {
        const div = document.createElement('div');
        div.classList.add('w-full', 'flex', 'justify-center', 'items-center');
        div.innerHTML = `
            <p class="text-2xl font-bold text-[#F2F3F3]">Please login to view booking history</p>
        `;
        cardContainer.appendChild(div);
    }
    else {
        const parsedPayload = JSON.parse(payload);
        const userId = parsedPayload.id;

        const token = getCookie('token');

        const raw = await fetch(`${API_URL}/${userId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const response = await raw.json();
        const data = response.data;
        console.log(data);
        if (data.length == 0) {
            const div = document.createElement('div');
            div.classList.add('w-full', 'flex', 'justify-center', 'items-center', 'py-12', 'border-t-4');
            div.innerHTML = `
            <p class="text-2xl font-bold text-[#413F42]">Data Not Found</p>
        `;
            cardContainer.appendChild(div);
        }

        else {
            data.forEach(items => {
                const div = document.createElement('div');
                div.classList.add('w-full', 'flex', 'flex-col', 'rounded-md', 'border-2', 'border-[#F2F3F3]');
                div.innerHTML = `
                        <!-- First Strip -->
                        <div class="flex justify-between p-4">
                            <p>Book Id ${items.id}</p>
                            <p class="font-bold">Rp ${formatToCurrency(items.total)}</p>
                        </div>

                        <!-- Second Strip -->
                        <div class="flex items-center gap-x-2 p-4 bg-[#F2F3F3]">
                            <div class="w-4">
                                <img src="/images/Bus.png" alt="Bus icon" />
                            </div>
                            <p class="ml-2">${items.departure}</p>
                            <div class="w-4">
                                <img src="/images/rightArrow.png" alt="Right Arrow" />
                            </div>
                            <p>${items.destination}</p>
                        </div>

                        <!-- Third Strip -->
                        <div class="flex flex-col p-4 w-full gap-y-4">
                            <!-- Calendar -->
                            <div class="w-full flex items-center gap-x-4">
                                <div class="w-4">
                                    <img src="/images/Calendar.png" alt="Calendar icon" />
                                </div>
                                <p>${items.date}</p>
                            </div>

                            <!-- Clock -->
                            <div class="w-full flex items-center gap-x-4">
                                <div class="w-4">
                                    <img src="/images/Clock.png" alt="Clock icon" />
                                </div>
                                <p>${items.time}</p>
                            </div>

                            <!-- Ticket -->
                            <div class="w-full flex items-center gap-x-2">
                                <p>Number of Ticket :</p>
                                <p>${items.ticket}</p>
                            </div>

                            <!-- Car Seat -->
                            <div class="w-full flex items-center gap-x-2">
                                <p>Seat : </p>
                                <p>${items.seat}</p>
                            </div>
                        </div>
                    </div>`;
                cardContainer.appendChild(div);
            });
        }
    }
}

InitialRender();


///////////////////////////////////////// Render /////////////////////////////////////////


///////////////////////////////////////// Function /////////////////////////////////////////
function getCookie(cName) {
    const name = cName + "=";
    const cDecoded = decodeURIComponent(document.cookie); //to be careful
    const cArr = cDecoded.split('; ');
    let res;
    cArr.forEach(val => {
        if (val.indexOf(name) === 0) res = val.substring(name.length);
    })
    return res
}

function formatToCurrency(number) {
    // Convert number to string and split into integer and decimal parts
    let parts = number.toString().split(".");
    let integerPart = parts[0];
    let decimalPart = parts.length > 1 ? "." + parts[1] : "";

    // Add commas for thousands separator in the integer part
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Combine integer and decimal parts
    return integerPart + decimalPart;
}

