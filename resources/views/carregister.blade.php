<!DOCTYPE html>
<html>
<head>

    <title>Car Registration</title>
    <meta charset="UTF-8">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-sky-50 min-h-screen flex items-center justify-center">

    <div class="w-[70%] bg-white rounded-2xl shadow-xl p-10 border border-sky-100">

        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-sky-700">
                Car Registration
            </h2>

            <p class="text-gray-500 mt-3 text-lg">
                Register client vehicle information
            </p>
        </div>


        <form action="#" method="POST" class="space-y-10">

            @csrf


            <div>
                <label 
                    for="client_name"
                    class="block text-lg font-semibold text-gray-700 mb-2">
                    Client Name
                </label>

                <input
                    type="text"
                    name="client_name"
                    id="client_name"
                    placeholder="Enter client name"
                    required
                    class="w-full h-14 px-4 text-lg rounded-xl border-gray-300 
                    shadow-sm focus:border-sky-500 focus:ring-sky-500">
            </div>


            <div>
                <label 
                    for="phone_number"
                    class="block text-lg font-semibold text-gray-700 mb-2">
                    Phone Number
                </label>

                <input
                    type="text"
                    name="phone_number"
                    id="phone_number"
                    placeholder="Enter phone number"
                    required
                    class="w-full h-14 px-4 text-lg rounded-xl border-gray-300
                    shadow-sm focus:border-sky-500 focus:ring-sky-500">
            </div>


            <div>
                <label 
                    for="number_plate"
                    class="block text-lg font-semibold text-gray-700 mb-2">
                    Car Number Plate
                </label>

                <input
                    type="text"
                    name="number_plate"
                    id="number_plate"
                    placeholder="Enter car number plate"
                    required
                    class="w-full h-14 px-4 text-lg rounded-xl border-gray-300
                    shadow-sm focus:border-sky-500 focus:ring-sky-500">
            </div>


       <button
class="w-full h-14 bg-sky-600 hover:bg-sky-700
text-white text-lg font-bold rounded-xl
shadow-lg transition duration-300">
Register Car
</button>


        </form>

    </div>

</body>
</html>

