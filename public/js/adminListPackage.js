const tableBody = document.getElementById('tableBody');
const addPackageButton = document.getElementById('addPackageButton');

const API_URL = '/api/package'
const DATA_PER_PAGE = 10;

var data = [];
var currentPage = 1;
var totalPages = 0;
var listPagination = [];

///////////////////////////////////////// Initial render /////////////////////////////////////////

async function InitialRender() {
    const res = await fetch(API_URL);
    const books = await res.json();
    data = books;
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
    const books = data.slice(start, end);
    books.forEach(book => {
        const tr = document.createElement('tr');
        tr.classList.add('border-b-4', 'border-[#B2A59B]');
        tr.innerHTML = `
            <td class="px-4 py-2 text-center">${book.id}</td>
            <td class="px-4 py-2 text-center">${book.name}</td>
            <td class="px-4 py-2 text-center">${book.description}</td>
            <td class="px-4 py-2 text-center">${book.price}</td>
            <td class="px-4 py-2 text-center">${book.departure}</td>
            <td class="px-4 py-2 text-center">${book.destination}</td>
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
        button.classList.add('p-2', 'bg-[#324B4E]', 'rounded-xl', 'w-10', 'text-white', 'hover:bg-[#657E7F]');
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
        button.classList.add('p-2', 'bg-[#324B4E]', 'rounded-xl', 'w-10', 'text-white', 'hover:bg-[#657E7F]');
        button.innerText = item;
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
        button.classList.add('p-2', 'bg-[#324B4E]', 'rounded-xl', 'w-10', 'text-white', 'hover:bg-[#657E7F]');
        button.innerHTML = `<img src="/images/Chevron-Right.png" >`;
        button.addEventListener('click', () => {
            listPagination = listPagination.map(item => item + 1);
            RenderPagination();
        });
        pagination.appendChild(button);
    }

}

///////////////////////////////////////// Event Listeners /////////////////////////////////////////

addPackageButton.addEventListener('click', () => {
    const form = document.getElementById('form');
    form.classList.remove('hidden');
    addPackageButton.classList.add('hidden');

    const dummyP = document.getElementById('dummyP');
    dummyP.classList.add('hidden');

    const titleListPackage = document.getElementById('titleListPackage');
    titleListPackage.classList.remove('justify-between');
    titleListPackage.classList.add('justify-center');
});