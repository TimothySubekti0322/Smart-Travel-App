const tableBody = document.getElementById('tableBody');

const API_URL = '/api/book'
const DATA_PER_PAGE = 10;

var data = [];
var currentPage = 1;
var totalPages = 0;
var listPagination = [];

///////////////////////////////////////// Initial render /////////////////////////////////////////

async function InitialRender() {
    const token = getCookie('token');
    if (!token) {
        window.location.href = '/login';
    }
    const res = await fetch(API_URL, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    });
    const books = await res.json();
    data = books.data;
    totalPages = Math.ceil(data.length / DATA_PER_PAGE);
    if (totalPages === 0) {
        const p = document.createElement('p');
        p.classList.add('text-center', 'text-2xl', 'text-[#B2A59B]');
        p.innerHTML = `No data`;
        tableBody.appendChild(p);
    }
    else {
        if (totalPages > 3) {
            listPagination = [1, 2, 3];
        }
        else {
            for (let i = 1; i <= totalPages; i++) {
                listPagination.push(i);
            }
        }
        console.log(totalPages);

        RenderTable();
        RenderPagination();
    }
}

InitialRender();

///////////////////////////////////////// Render /////////////////////////////////////////

// Render the table
function RenderTable() {
    tableBody.innerHTML = '';
    const start = (currentPage - 1) * DATA_PER_PAGE;
    const end = currentPage * DATA_PER_PAGE;
    console.log(start, end);
    const books = data.slice(start, end);
    console.log(books);
    books.forEach(book => {
        const tr = document.createElement('tr');
        tr.classList.add('border-b-4', 'border-[#B2A59B]');
        tr.innerHTML = `
            <td class="px-4 py-2 text-center">${book.id}</td>
            <td class="px-4 py-2 text-center">${book.email}</td>
            <td class="px-4 py-2 text-center">${book.date}</td>
            <td class="px-4 py-2 text-center">${book.time}</td>
            <td class="px-4 py-2 text-center">${book.departure}</td>
            <td class="px-4 py-2 text-center">${book.destination}</td>
            <td class="px-4 py-2 text-center">${book.ticket}</td>
            <td class="px-4 py-2 text-center">${book.total}</td>
        `;
        tableBody.appendChild(tr);
    });
}



// Render the Pagination
function RenderPagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    // Chevron Right
    if (!(listPagination.includes(1))) {
        const button = document.createElement('button');
        button.classList.add('p-2', 'bg-[#324B4E]', 'rounded-xl', 'w-10', 'text-white', 'hover:bg-[#AD8BAB]');
        button.innerHTML = `<img src="/images/Chevron-Left.png" >`;
        button.addEventListener('click', () => {
            listPagination = listPagination.map(item => item - 1);
            RenderPagination();
        });
        pagination.appendChild(button);
    }

    // List Page
    console.log(listPagination);
    listPagination.forEach(item => {
        const button = document.createElement('button');
        button.classList.add('p-2', 'rounded-xl', 'w-10', 'text-white', 'hover:bg-[#AD8BAB]');
        button.innerText = item;
        if (item === currentPage) {
            button.classList.add('bg-[#AD8BAB]');
        }
        else {
            button.classList.add('bg-[#324B4E]');
        }
        button.addEventListener('click', () => {
            currentPage = item;
            RenderTable();
            RenderPagination();
        });
        pagination.appendChild(button);
    });

    // Chevron right
    if (!(listPagination.includes(totalPages))) {
        const button = document.createElement('button');
        button.classList.add('p-2', 'bg-[#324B4E]', 'rounded-xl', 'w-10', 'text-white', 'hover:bg-[#AD8BAB]');
        button.innerHTML = `<img src="/images/Chevron-Right.png" >`;
        button.addEventListener('click', () => {
            listPagination = listPagination.map(item => item + 1);
            RenderPagination();
        });
        pagination.appendChild(button);
    }

}

///////////////////////////////////////// Event Listeners /////////////////////////////////////////

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