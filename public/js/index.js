async function renderCardSection() {
    const data = await fetch('/api/package', {
        method: 'GET',
    });
    const packages = await data.json();

    const cardSection = document.getElementById('cardSection');
    cardSection.innerHTML = '';

    packages.forEach(package => {
        const price = formatToCurrency(package.price);
        const cardItem = document.createElement('div');
        cardItem.classList.add('w-[20rem]', 'xl:w-[24rem]', '2xl:w-[30rem]', 'bg-[#F5F5F5]', 'rounded-xl', 'flex', 'flex-col');
        cardItem.innerHTML = `<img src="/images/Car.webp" alt="car" class="w-full rounded-t-xl">
                <div class="p-4">
                    <!-- Informasi -->
                    <div class="flex justify-between w-full">
                        <div class="text-xl">${package.name}</div>
                        <div class="text-xl text-[#EC927E]">Rp ${price}<span class="text-[#687176] text-sm ml-2">/Kursi</span></div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-2 text-[#A5AAB3]">${package.description}</div>

                    <!-- Max Capacity -->
                    <div class="mt-6 flex">
                        <img src="/images/Person.png" class="w-6" alt="person"><div class="text-xl ml-2">8 person</div>
                    </div>

                    <!-- Destination -->
                    <div class="flex justify-between items-center mt-6 pr-8 border-y-2 border-[#D3D3D3] py-4">
                        <div class="flex flex-row items-center">
                            <div class="w-6">
                                <img src="/images/Location.png" class="w-full" alt="location">
                            </div>
                            <div class="flex flex-col ml-2">
                                <div class="font-bold">From</div>
                                <div class="text-[#A9A9A9]">${package.departure}</div>
                            </div>
                        </div>
                            <div class="flex flex-row items-center">
                            <div class="w-6">
                                <img src="/images/Location.png" class="w-full" alt="location">
                            </div>
                            <div class="flex flex-col ml-2">
                                <div class="font-bold">To</div>
                                <div class="text-[#A9A9A9]">${package.destination}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Button -->
                    <a href="book/${package.id}" class="flex justify-center mt-6">
                        <button class="my-4 bg-[#EC927E] hover:bg-[#DB816D] py-2 px-8 rounded-[4rem] text-white font-bold w-1/2">Book Now</button>
                    </a>
                </div>`;
        cardSection.appendChild(cardItem);
    });
}

renderCardSection();

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