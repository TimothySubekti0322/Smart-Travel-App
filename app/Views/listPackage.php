<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Package</title>
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

    <!-- Recomendation -->
    
    <!-- Form -->
    <form id="form" class="w-full flex flex-col justify-center items-center hidden" method="POST" action="/api/package" enctype="multipart/form-data">
        <div class="w-1/2 rounded-xl flex flex-col mt-8 border-2 border-black p-10 mt-12">
                <p class="text-2xl font-bold text-center w-full">Add Package</p>
                <div class="w-full flex flex-col mt-8">
                    <label for="name" class="text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full border-2 border-[#B2A59B] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#B2A59B] focus:border-transparent" placeholder="Ex: Executive" />
                </div>

                <div class="w-full flex flex-col mt-8">
                    <label for="description" class="text-gray-700 font-bold mb-2">Description</label>
                    <input type="text" id="description" name="description" class="w-full border-2 border-[#B2A59B] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#B2A59B] focus:border-transparent" placeholder="Ex: Toyota hi-ace-8" />
                </div>

                <div class="w-full flex flex-col mt-8">
                    <label for="price" class="text-gray-700 font-bold mb-2">Price</label>
                    <input type="number" id="price" min="1" name="price" class="w-full border-2 border-[#B2A59B] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#B2A59B] focus:border-transparent" placeholder="Price" />
                    <i class="mt-2">Price in rupiah</i>
                </div>

                <div class="w-full flex flex-col mt-8">
                    <label for="departure" class="text-gray-700 font-bold mb-2">Departure</label>
                    <input type="text" id="departure" name="departure" class="w-full border-2 border-[#B2A59B] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#B2A59B] focus:border-transparent" placeholder="Ex: Solo" />
                </div>

                <div class="w-full flex flex-col mt-8">
                    <label for="destination" class="text-gray-700 font-bold mb-2">Destination</label>
                    <input type="text" id="destination" name="destination" class="w-full border-2 border-[#B2A59B] rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#B2A59B] focus:border-transparent" placeholder="Ex: Solo" />
                </div>

                <button type="submit" class="mt-8 px-6 py-3 mx-auto bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-800 hover:to-blue-800 text-white font-bold rounded-xl">
                    Add Package
                </button>
        </div>
    </form>

    <div class="w-full flex flex-col justify-center items-center">
        <div id="titleListPackage" class="w-4/5 flex justify-between items-center mb-4 mt-12">
            <p id="dummyP"></p>
            <p class="text-2xl font-bold">List of Package</p>
            <button id="addPackageButton" class="px-4 py-2 bg-[#83A2FF] rounded-xl hover:bg-[#6180DD] text-white font-bold">add Package</button>
        </div>

        <div class="w-4/5 my-10 mt-8">
            <table id="bookTable" class="w-full table-auto">
                <!-- Table header -->
                <thead>
                    <tr>
                        <th class="bg-[#607274] text-white px-4 py-2">Id</th>
                        <th class="bg-[#607274] text-white px-4 py-2">Name</th>
                        <th class="bg-[#607274] text-white px-4 py-2">Description</th>
                        <th class="bg-[#607274] text-white px-4 py-2">Price</th>
                        <th class="bg-[#607274] text-white px-4 py-2">Departure</th>
                        <th class="bg-[#607274] text-white px-4 py-2">Destination</th>
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

    <script src="/js/adminListPackage.js"></script>
</body>
</html>