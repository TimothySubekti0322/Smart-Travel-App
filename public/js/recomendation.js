const highestCity = document.getElementById('highestCity');
const highestBook = document.getElementById('highestBook');
const recomendationSection = document.getElementById('recomendationSection');

const API = 'http://localhost:8081/reportAPItop';

async function initialRender() {
    const rawData = await fetch(API_URL);
    const data = await rawData.json();

    if (data) {
        recomendationSection.classList.remove('hidden');
        highestCity.innerHTML = city;
        highestBook.innerHTML = `${quantity} Customers`;
    }
}

initialRender();