<?php

if (!isset($_COOKIE['payload'])) {
    header("Location: localhost:8080/login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Book Chart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <header class="absolute w-full bg-white flex justify-between items-center p-8 h-24 shadow-xl">
        <!-- Logo -->
        <div>
            <a href="/"><img src="/images/logo.png" alt="logo" class="h-8" /></a>
        </div>

        <!-- Menu -->
        <div class="flex items-center gap-x-4">
            <a href="/admin/bookChart" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Booking Data</a>
            <a href="/admin/listPackage" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">List Package</a>
            <a href="/admin/hotelChart" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Hotel Order Data</a>
        </div>

        <!-- Sign Up -->
        <div class="flex items-center">
            <?php
            if (isset($_COOKIE['payload'])) {
                $payload = json_decode($_COOKIE['payload'], true); // Decode JSON to PHP array

                // Check if 'name' key exists in the decoded payload
                if (isset($payload['name'])) {
                    echo '<p class="text-gray-700 mr-4 font-bold">' . $payload['name'] . '</p>';
                    echo '<p class="text-gray-700 mr-4 font-bold">|</p>'; // Added separator
                    echo '<a href="/logout" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">sign out</a>';
                } else {
                    echo '<a href="/login" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Login</a>';
                    echo '<p class="text-gray-700 mr-4 font-bold">|</p>'; // Added separator
                    echo '<a href="/register" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Sign up</a>';
                }
            } else {
                echo '<a href="/login" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Login</a>';
                echo '<p class="text-gray-700 mr-4 font-bold">|</p>'; // Added separator
                echo '<a href="/register" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Sign up</a>';
            }
            ?>
        </div>
    </header>

    <!-- Fill Header -->
    <div class="h-24 w-full"></div>

    <div class="w-full flex flex-col justify-center items-center">
        <p class="text-2xl font-bold mb-8 mt-24">Booking Chart Analytics</p>
        <div class="w-4/5">
            <canvas id="myChart"></canvas>
        </div>
        <p class="text-2xl font-bold mb-4 mt-24">Booking Order Table</p>

        <div class="w-4/5 my-10 mt-8 overflow-x-auto">
            <table id="bookTable" class="w-full table-auto">
                <!-- Table header -->
                <thead>
                    <tr>
                        <th class="bg-[#607274] text-white px-4 py-2">Id</th>
                        <th class="bg-[#607274] text-white px-4 py-2">email</th>
                        <th class="bg-[#607274] text-white px-4 py-2">date</th>
                        <th class="bg-[#607274] text-white px-4 py-2">time</th>
                        <th class="bg-[#607274] text-white px-4 py-2">Departure</th>
                        <th class="bg-[#607274] text-white px-4 py-2">Destination</th>
                        <th class="bg-[#607274] text-white px-4 py-2">ticket</th>
                        <th class="bg-[#607274] text-white px-4 py-2">total</th>
                    </tr>
                </thead>
                <!-- Table body to be filled by JavaScript -->
                <tbody id="tableBody">
                    <tr class="border-b-4 border-[#B2A59B]">

                    </tr>
                </tbody>
            </table>

            <div id="pagination" class="flex justify-center items-center mt-8 gap-x-4">

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        const response = fetch('/api/bookAnalytics', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'email': 'admin@gmail.com',
                    'password': 'admin'
                })
            }).then(response => response.json())
            .then(data => {
                console.log(data);
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.label,
                        datasets: [{
                            label: 'Number of Bookings',
                            data: data.data,
                            backgroundColor: [
                                'rgba(199, 112, 7, 0.6)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });
    </script>
    <script src="/js/adminBookTable.js" charset="utf-8"></script>
</body>

</html>