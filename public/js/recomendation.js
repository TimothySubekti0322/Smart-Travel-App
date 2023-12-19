const highestCity = document.getElementById('highestCity');
const highestBook = document.getElementById('highestBook');
const recomendationSection = document.getElementById('recomendationSection');

const API = 'http://localhost:8081/reportAPItop';

async function initialRender() {
    const form = new FormData();
    form.append('email', 'admin@gmail.com');
    form.append('password', 'admin');
    const rawData = await fetch(API, {
        method: "post",
        body: form
    });
    const data = await rawData.json();

    if (data) {
        recomendationSection.classList.remove('hidden');
        highestCity.innerHTML = data.city[0];
        highestBook.innerHTML = `${data.quantity[0]} Customers`;
    }
}

initialRender();