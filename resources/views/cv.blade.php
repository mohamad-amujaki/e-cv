<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Mohamad Arif Mujaki</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@4.1.8/dist/lib.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 antialiased leading-relaxed">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg my-8">

        <header class="text-center py-4 border-b border-gray-200 mb-6">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Mohamad Arif Mujaki</h1>
            <p class="text-xl text-gray-600">{{ $occupation }}</p>
        </header>

        <main>
            <section id="introduction" class="mb-8 p-6 bg-blue-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-blue-700 border-b-2 border-blue-500 pb-2 mb-4">Introduction</h2>
                <p>
                    Hello! I'm Mohamad Arif Mujaki, a civil servant dedicated to public service, with a keen and growing interest in the transformative power of technology. My professional life is rooted in contributing to the well-being of our community, while my personal journey increasingly involves diving deep into the world of coding. I believe that effective governance can be significantly amplified by smart technological solutions.
                </p>
            </section>

            <section id="personal-info" class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-blue-700 border-b-2 border-blue-500 pb-2 mb-4">Personal Info</h2>
                <p><strong class="font-medium">Name:</strong> {{ $name }}</p>
                <p><strong class="font-medium">Occupation:</strong> {{ $occupation }}</p>
                <p><strong class="font-medium">Email:</strong> {{ $email }}</p>
                <p><strong class="font-medium">Location:</strong> Jakarta, Indonesia</p>
            </section>

            <section id="interest" class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-green-700 border-b-2 border-green-500 pb-2 mb-4">Interest Tech & Skills</h2>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    <li>{{ $interests }}</li>
                    <li>Data Analysis</li>
                    <li>Process Automation</li>
                </ul>
            </section>

        </main>
        <footer class="text-center text-gray-500 text-sm mt-8 py-4 border-t border-gray-200">
            <p>&copy; {{ date('Y') }} For inquiries, please connect with me through my blog: <a href="{!! url("https://mohamad-amujaki.blogspot.com") !!}" target="_blank" class="text-blue-600 hover:underline">Jaki's' Insight</a></p>
        </footer>
    </div>
</body>

</html>
