<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
        <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bg-[url('/images/loginBG.jpg')] bg-cover w-screen h-screen flex flex-col justify-center items-center">
        <div class="w-screen h-screen bg-black opacity-40 absolute"></div>
        <form class="z-[1] flex flex-col justify-center items-center w-full" action="/register" method="POST" enctype="multipart/form-data">
            <div class="text-white text-[3.5rem] opacity-100 ">Register</div>
            <input type="text" class="rounded-[4rem] bg-black opacity-70 text-white mt-12 w-2/5 xl:px-4 xl:py-4 2xl:px-6 2xl:py-6 xl:text-base 2xl:text-xl" name="email" placeholder="email"/>
            <input type="text" class="rounded-[4rem] bg-black opacity-70 text-white mt-12 w-2/5 xl:px-4 xl:py-4 2xl:px-6 2xl:py-6 xl:text-base 2xl:text-xl" name="username" placeholder="username"/>
            <input type="password" class="rounded-[4rem] bg-black opacity-70 text-white mt-12 w-2/5 xl:px-4 xl:py-4 2xl:px-6 2xl:py-6 xl:text-base 2xl:text-xl" name="password" placeholder="password"/>
            <button type="submit" class="rounded-[4rem] bg-[#D8E4F2] hover:bg-[#B6C2D0] xl:text-base 2xl:text-xl text-black mt-12 w-2/5 xl:px-2 xl:py-3 2xl:px-4 2xl:py-6 font-bold">Register</button>
        </form>
        <p class="mt-12 text-white z-[1]">already have account ? <a href="/login" class="text-[#3559E0] hover:underline">login</a> here</p>
    </div>
</body>
</html>