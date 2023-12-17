<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Travel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>

<body class="bg-[#EEEEEE]">
    <header class="absolute w-full bg-white flex justify-between items-center p-8 h-24 shadow-xl">
        <!-- Logo -->
        <div>
            <a href="/"><img src="/images/logo.png" alt="logo" class="h-8" /></a>
        </div>

        <!-- Menu -->
        <div class="flex items-center gap-x-4">
            <a href="/" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Home</a>
            <a href="/" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Package</a>
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

    <form action="/book" method="POST" enctype="multipart/form-data" class="w-full flex justify-center">
        <div class="xl:w-3/5 2xl:w-1/2 flex flex-col mt-16">
            <p class="font-bold text-[2rem]">Pemesanan Anda</p>
            <p class="text-[#687176] mt-2">Isi data Anda dan review Pesanan Anda</p>

            <!-- form & details -->
            <section class="w-full mt-4">
                <div class="grid grid-cols-3 gap-4">

                    <!-- Form Booking -->
                    <div class="col-span-2 bg-white rounded-xl shadow-md">
                        <div class="flex flex-col gap-y-4 p-8">
                            <div class="flex flex-col gap-y-2">
                                <label for="name" class="text-[#687176]">Full Name</label>
                                <input type="text" name="name" id="name" class="border border-[#EAEAEA] rounded-xl p-4" />
                                <i id="nameError" class="text-[#BE3144] hidden">Please Input Your Name</i>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="email" class="text-[#687176]">Email</label>
                                <input type="text" name="email" id="email" class="border border-[#EAEAEA] rounded-xl p-4" />
                                <i id="emailError" class="text-[#BE3144] hidden">Please Input Your Email</i>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="telephone" class="text-[#687176]">Phone Number</label>
                                <input type="text" name="telephone" id="telephone" class="border border-[#EAEAEA] rounded-xl p-4" />
                                <i id="telephoneError" class="text-[#BE3144] hidden">Please Input Your Phone Number</i>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="date" class="text-[#687176]">Date</label>
                                <input type="date" name="date" id="date" class="border border-[#EAEAEA] rounded-xl p-4" />
                                <i id="dateError" class="text-[#BE3144] hidden">Please Select Date</i>
                                <i id="dateNotValid" class="text-[#BE3144] hidden">Please Select Valid Date</i>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="time" class="text-[#687176]">Departure Time</label>
                                <select name="time" id="time" class="border border-[#EAEAEA] rounded-xl p-4" >
                                    <option value="" selected disabled hidden>Select Time</option>
                                    <option value="08:00">08:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="20:00">20:00</option>
                                </select>
                                <i id="timeError" class="text-[#BE3144] hidden">Please Select Time</i>
                            </div>
                            <div class="w-full flex justify-center mt-6">
                                <button type="button" id="chooseSeatButton" class="w-1/2 bg-[#EC927E] px-4 py-2 rounded-xl text-white hover:bg-[#CA705C]" >Choose Seat</button>
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div id="detailsContainer" class="col-span-1 bg-white rounded-xl p-4 h-fit">
                        <text class="font-bold text-xl">Details</text>
                        <div class="flex flex-col gap-y-2 mt-4">
                            <div class="flex justify-between">
                                <text class="text-[#687176]">Package</text>
                                <text id="packageName" class="text-[#687176]"></text>
                            </div>
                            <div class="flex justify-between">
                                <text class="text-[#687176]">Car Type</text>
                                <text id="packageDescription" class="text-[#687176]"></text>
                            </div>
                            <div id="departureDateSection" class="flex justify-between invisible">
                                <text class="text-[#687176]">Date</text>
                                <text id="departureDate" class="text-[#687176]"></text>
                            </div>
                            <div id="departureTimeSection" class="flex justify-between mt-4 invisible">
                                <text id="departureLocation" class="text-black"></text>
                                <text id="departureTime" class="text-black"></text>
                            </div>
                            <div id="divider" class="flex justify-between px-4 invisible">
                                <text class="text-black">|</text>
                                <text class="text-black">|</text>
                            </div>
                            <div id="arrivalTimeSection" class="flex justify-between invisible">
                                <text id="arrivalLocation" class="text-black"></text>
                                <text id="arrivalTime" class="text-black"></text>
                            </div>
                            
                            <div id="totalSection" class="w-full flex justify-between border-t-4 pt-4 mt-4 invisible">
                                <text class="text-black">Total</text>
                                <text id="total" class="text-black"></text>
                            </div>
                        </div>
                    </div>

                    <!-- Choose Seat -->
                    <div id="seatForm" class="col-span-2 bg-white rounded-xl shadow-md px-4 py-8 flex flex-col items-center invisible">
                        
                    </div>

                    <!-- Dummy -->
                    <div class="col-span-1"></div>

                    <div id="submitSection" class="col-span-2 flex justify-end mb-4 invisible">
                        <button type="submit" id="submitButton" class="w-1/4 bg-[#A9A9A9] px-4 py-2 rounded-xl text-white">Book</button>
                    </div>
            </section>
        </div>
    </form>

    <script src="/js/booking.js" charset="utf-8"></script>
</body>

</html>