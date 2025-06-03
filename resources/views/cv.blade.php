<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Mohamad Arif Mujaki</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-2xl w-full">
        <h1 class="text-4xl font-bold text-gray-800 mb-4 text-center">Mohamad Arif Mujaki</h1>
        <p class="text-lg text-gray-600 mb-6 text-center">{{ $occupation }}</p>

        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Introduction</h2>
            <p class="text-gray-700 leading-relaxed">
                Hello! I'm Mohamad Arif Mujaki, a civil servant dedicated to public service, with a keen and growing interest in the transformative power of technology. My professional life is rooted in contributing to the well-being of our community, while my personal journey increasingly involves diving deep into the world of coding. I believe that effective governance can be significantly amplified by smart technological solutions.
            </p>

            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Interests</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-1">
                <li>{{ $interests }}</li>
                <li>Data Analysis</li>
                <li>Process Automation</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Contact</h2>
            <p class="text-gray-700">
                For inquiries, please connect with me through my blog: <a href="mohamad-amujaki.blogspot.com" class="text-blue-600 hover:underline">Jaki's' Insight</a>
            </p>
        </div>
    </div>
</body>
</html>
