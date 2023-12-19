const date = document.getElementById('date');
const dateError = document.getElementById('dateError');
const dateNotValid = document.getElementById('dateNotValid');
const time = document.getElementById('time');
const timeError = document.getElementById('timeError');
const chooseSeatButton = document.getElementById('chooseSeatButton');
const nameInput = document.getElementById('name');
const nameError = document.getElementById('nameError');
const emailInput = document.getElementById('email');
const emailError = document.getElementById('emailError');
const telephoneInput = document.getElementById('telephone');
const telephoneError = document.getElementById('telephoneError');

var nameValue = "";
var emailValue = "";
var telephoneValue = "";
var dateValue = "";
var rawDateValue = "";
var timeValue = "";

var id = "";
var departure = "";
var arrival = "";
var seatSelected = [];
var totalPrice = 0;
var price = 0;

////////////////////////////////////// Render //////////////////////////////////////

// Initial Render Details
async function renderInitialDetails() {
    id = getPackageIdFromUrl()
    const response = await fetch(`/api/package/${id}`);
    const data = await response.json();
    // console.log(data);

    const packageName = document.getElementById('packageName');
    packageName.textContent = '';
    packageName.textContent = data.name;
    const packageDescription = document.getElementById('packageDescription');
    packageDescription.textContent = '';
    packageDescription.textContent = data.description;
    departure = data.departure;
    arrival = data.destination;
    price = parseInt(data.price);
}

renderInitialDetails();

// Render Seat
async function renderSeats() {

    const seatForm = document.getElementById('seatForm');
    seatForm.innerHTML = '';

    const p = document.createElement('p');
    p.classList.add('text-2xl', 'font-bold', 'mb-16');
    p.textContent = 'Choose Your Seat';

    const seatFilled = await fetch(`/api/checkSeat`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ date: dateValue, time: timeValue, packageId: id })
    });
    const seatFilledData = await seatFilled.json();
    // console.log(seatFilledData);

    seatForm.classList.remove('invisible');
    const seatLayout = [
        ['S1', null, 'Driver'],
        [null, 'S5', 'S6'],
        ['S7', null, 'S9'],
        ['S10', 'S11', 'S12']
    ];

    const grid = document.createElement('div');
    grid.classList.add('grid', 'grid-cols-3', 'w-4/5', '2xl:w-3/5', 'gap-8');

    for (let i = 0; i < 4; i++) {
        for (let j = 0; j < 3; j++) {
            const seat = seatLayout[i][j];

            // Driver Seat
            if (j == 2 && i == 0) {
                const button = document.createElement('button');
                button.textContent = seat;
                button.classList.add('rounded-2xl', 'outline', 'p-8', 'flex', 'justify-center', 'bg-[#A8A196]');
                button.setAttribute('disabled', true);
                grid.appendChild(button);
            }
            else if ((j == 1 && i == 0) || (j == 0 && i == 1) || (j == 1 && i == 2)) {
                const emptySeat = document.createElement('button');
                emptySeat.classList.add('invisible');
                grid.appendChild(emptySeat);
            }

            // seat Filled
            else if (seatFilledData.data.includes(seat)) {
                const button = document.createElement('button');
                button.textContent = seat;
                button.classList.add('rounded-2xl', 'outline', 'p-8', 'flex', 'justify-center', 'bg-[#31304D]', 'text-white');
                button.setAttribute('disabled', true);
                grid.appendChild(button);
            }

            // Seat Empty
            else {
                const button = document.createElement('button');
                button.textContent = seat;
                button.classList.add('rounded-2xl', 'outline', 'p-8', 'flex', 'justify-center', 'hover:bg-[#FFBB5C]', 'seatButton');
                button.setAttribute('type', `button`);
                grid.appendChild(button);
            }
        }
    }
    seatForm.appendChild(grid);

    // Seat Button Event Listener
    const seatButton = document.querySelectorAll('.seatButton');
    seatButton.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const seat = e.target.textContent;
            if (seatSelected.includes(seat)) {
                seatSelected = seatSelected.filter(item => item !== seat);
                button.classList.remove('bg-[#FFBB5C]');
            }
            else {
                seatSelected.push(seat);
                button.classList.add('bg-[#FFBB5C]');
            }

            totalPrice = price * seatSelected.length;

            renderTotalPayment();
            renderBookButton();

            // console.log(seatSelected);
        })
    })

    const submitSection = document.getElementById('submitSection');
    const submitButton = document.getElementById('submitButton');
    submitButton.setAttribute('disabled', true);
    submitSection.classList.remove('invisible');
}

// Render Details
function renderDetails() {

    const departureDateSection = document.getElementById('departureDateSection');
    departureDateSection.classList.remove('invisible');

    const departureDate = document.getElementById('departureDate');
    departureDate.textContent = dateValue;

    const departureTimeSection = document.getElementById('departureTimeSection');
    departureTimeSection.classList.remove('invisible');

    const departureTime = document.getElementById('departureTime');
    departureTime.textContent = timeValue;

    const divider = document.getElementById('divider');
    divider.classList.remove('invisible');

    const arrivalTimeSection = document.getElementById('arrivalTimeSection');
    arrivalTimeSection.classList.remove('invisible');

    const arrivalTime = document.getElementById('arrivalTime');
    arrivalTime.textContent = addTwoHours(timeValue);

    const departureLocation = document.getElementById('departureLocation');
    departureLocation.textContent = departure;

    const arrivalLocation = document.getElementById('arrivalLocation');
    arrivalLocation.textContent = arrival;

    const totalSection = document.getElementById('totalSection');
    totalSection.classList.remove('invisible');

    const total = document.getElementById('total');
    total.textContent = "Rp 0";
}

// Render Total Payment
function renderTotalPayment() {
    const total = document.getElementById('total');
    total.textContent = `Rp ${formatToCurrency(totalPrice)}`;
}

// Render Book Button
function renderBookButton() {
    const submitButton = document.getElementById('submitButton');
    if (seatSelected.length == 0) {
        submitButton.setAttribute('disabled', true);
        submitButton.classList.remove('bg-[#007CE8]', 'hover:bg-[#229EEA]');
        submitButton.classList.add('bg-[#A9A9A9]');
    }
    else {
        submitButton.removeAttribute('disabled');
        submitButton.classList.remove('bg-[#A9A9A9]');
        submitButton.classList.add('bg-[#007CE8]', "hover:bg-[#229EEA]");
    }
}

////////////////////////////////////// Event Listener //////////////////////////////////////

// Name Event Listener
nameInput.addEventListener('change', (e) => {
    const nameValue = e.target.value;
    // console.log(nameValue);
})

// Email Event Listener
emailInput.addEventListener('change', (e) => {
    const emailValue = e.target.value;
    // console.log(emailValue);
})

// Telephone Event Listener
telephoneInput.addEventListener('change', (e) => {
    const telephoneValue = e.target.value;
    // console.log(telephoneValue);
})

// Date Event Listener
date.addEventListener('change', (e) => {
    const selectedDate = new Date(e.target.value);
    rawDateValue = selectedDate;
    dateValue = formatDate(selectedDate);
    // console.log(dateValue);
})

// Time Event Listener
time.addEventListener('change', (e) => {
    const selectedTime = e.target.value;
    timeValue = selectedTime;
    // console.log(selectedTime);
});

// Choose Seat Event Listener
chooseSeatButton.addEventListener('click', (e) => {
    e.preventDefault();
    date.classList.remove('outline');
    date.classList.remove('outline-[#BE3144]');
    dateError.classList.add('hidden');

    time.classList.remove('outline');
    time.classList.remove('outline-[#BE3144]');
    timeError.classList.add('hidden');

    dateNotValid.classList.add('hidden');

    if (dateValue === "" && timeValue === "") {
        date.classList.add('outline');
        date.classList.add('outline-[#BE3144]');
        dateError.classList.remove('hidden');

        time.classList.add('outline');
        time.classList.add('outline-[#BE3144]');
        timeError.classList.remove('hidden');
    }
    else if (timeValue === "") {
        time.classList.add('outline');
        time.classList.add('outline-[#BE3144]');
        timeError.classList.remove('hidden');
    }
    else if (dateValue === "") {
        date.classList.add('outline');
        date.classList.add('outline-[#BE3144]');
        dateError.classList.remove('hidden');
    }
    else {
        // Check Date
        if (!dateValid(rawDateValue)) {
            date.classList.add('outline');
            date.classList.add('outline-[#BE3144]');
            dateNotValid.classList.remove('hidden');
        }

        // Input Valid
        else {
            renderSeats();
            renderDetails();
        }
    }
})

// Submit Event Listener
const submitButton = document.getElementById('submitButton');
submitButton.addEventListener('click', (e) => {
    e.preventDefault();
    const name = nameInput.value;
    const email = emailInput.value;
    const telephone = telephoneInput.value;
    // console.log(name, email, telephone);

    // Check Name, Email, Telephone
    if (nameValid() && emailValid() && telephoneValid()) {
        const date = dateValue;
        const time = timeValue;
        const packageId = id;
        const seat = seatSelected.join(',');
        const ticket = seatSelected.length;
        const total = totalPrice;

        const payload = JSON.parse(getCookie('payload'));
        const userId = payload.id;


        const data = {
            userId,
            name,
            email,
            telephone,
            date,
            time,
            packageId,
            seat,
            ticket,
            total
        }

        fetch(`/api/book`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        }).then(response => {
            // console.log(response.status);
            if (response.status == 200) {
                resetVariable();
                window.location.href = "/success"
            }
            else {
                alert("Booking Failed");
            }
        })
    }
});


////////////////////////////////////// Function //////////////////////////////////////

// Format Date Function
function formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // January is 0!
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
}

// Date Valid Function
function dateValid(date) {
    const selectedDate = new Date(date);
    const today = new Date();
    if (selectedDate < today) {
        return false;
    }
    return true;
}

// function add two hours
function addTwoHours(timeString) {
    // Split the time string into hours and minutes
    const [hours, minutes] = timeString.split(':');

    // Create a Date object and set the hours and minutes
    const date = new Date();
    date.setHours(parseInt(hours, 10) + 2);
    date.setMinutes(parseInt(minutes, 10));

    // Get the updated hours and minutes
    const updatedHours = String(date.getHours()).padStart(2, '0');
    const updatedMinutes = String(date.getMinutes()).padStart(2, '0');

    // Return the updated time as a string
    return `${updatedHours}:${updatedMinutes}`;
}

// Get Package Id From Url
function getPackageIdFromUrl() {
    const url = window.location.href;
    const urlSplit = url.split('/');
    const packageId = urlSplit[urlSplit.length - 1];
    return packageId;
}

// Extract Number From String
function extractNumberFromString(str) {
    // Use regex to extract the number part
    const match = str.match(/\d+/);
    if (match) {
        return parseInt(match[0]); // Convert the matched number to an integer
    }
    return null; // Return null if no number is found
}

// Format Number to Currency
function formatToCurrency(number) {
    // Convert number to string and split into integer and decimal parts
    let parts = number.toString().split(".");
    let integerPart = parts[0];
    let decimalPart = parts.length > 1 ? "." + parts[1] : "";

    // Add commas for thousands separator in the integer part
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // Combine integer and decimal parts
    return integerPart + decimalPart;
}

// Get Cookie
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

// reset variable
function resetVariable() {
    nameValue = "";
    emailValue = "";
    telephoneValue = "";
    dateValue = "";
    rawDateValue = "";
    timeValue = "";

    id = "";
    departure = "";
    arrival = "";
    seatSelected = [];
    totalPrice = 0;
    price = 0;
}

// Check Name Input

function nameValid() {
    if (!(nameInput.value)) {
        nameInput.classList.add('outline');
        nameInput.classList.add('outline-[#BE3144]');
        nameError.classList.remove('hidden');
        return false;
    }
    else {
        nameInput.classList.remove('outline');
        nameInput.classList.remove('outline-[#BE3144]');
        nameError.classList.add('hidden');
        return true;
    }
}

function emailValid() {
    if (!(emailInput.value)) {
        emailInput.classList.add('outline');
        emailInput.classList.add('outline-[#BE3144]');
        emailError.classList.remove('hidden');
        return false;
    }
    else {
        emailInput.classList.remove('outline');
        emailInput.classList.remove('outline-[#BE3144]');
        emailError.classList.add('hidden');
        return true;
    }
}

function telephoneValid() {
    if (!(telephoneInput.value)) {
        telephoneInput.classList.add('outline');
        telephoneInput.classList.add('outline-[#BE3144]');
        telephoneError.classList.remove('hidden');
        return false;
    }
    else {
        telephoneInput.classList.remove('outline');
        telephoneInput.classList.remove('outline-[#BE3144]');
        telephoneError.classList.add('hidden');
        return true;
    }
}