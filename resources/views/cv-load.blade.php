<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['personal']['name'] ?? 'Curriculum Vitae' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@4.1.8/dist/lib.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $data["personal"]["name"] ?? "N/A" }}</h1>
            <p class="text-xl text-gray-600">{{ $data["personal"]["title"] ?? "N/A" }}</p>
        </header>

        <main>
            <section id="introduction" class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-green-700 border-b-2 border-green-500 pb-2 mb-4">Introduction</h2>
                <p>
                    {{ $data["personal"]["summary"] ?? "N/A" }}
                </p>
            </section>

            @isset($data['personal'])
            <section id="personal-info" class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-green-700 border-b-2 border-green-500 pb-2 mb-4">Personal Info</h2>
                <h1>{{ $data['personal']['name'] }}</h1> {{-- Diubah --}}
                <h2>{{ $data['personal']['title'] }}</h2> {{-- Diubah --}}
                <div class="contact-info">
                    @isset($data['personal']['email'])
                    <div class="flex items-center gap-2">
                        <i class="fas fa-envelope text-blue-600"></i>
                        <a href="mailto:{{ $data['personal']['email'] }}" class="hover:underline">{{ $data['personal']['email'] }}</a>
                    </div>
                    @endisset
                    @isset($data['personal']['phone']) {{-- Diubah --}}
                    <div><i class="fas fa-phone-alt"></i> <a href="tel:{{ $data['personal']['phone'] }}">{{ $data['personal']['phone'] }}</a></div> {{-- Diubah --}}
                    @endisset
                    @isset($data['personal']['location']) {{-- Diubah --}}
                    <div><i class="fas fa-map-marker-alt"></i> {{ $data['personal']['location'] }}</div> {{-- Diubah --}}
                    @endisset
                </div>
            </section>
            @endisset

            @isset($data['skills'])
            <section id="interest" class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-green-700 border-b-2 border-green-500 pb-2 mb-4">Interest Tech & Skills</h2>

                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    @foreach ( $data["skills"] as $cats => $listSkill )
                    <li> {{ Str::title("$cats") }}
                        <ul class="list-disc ml-10">
                            @foreach ( $listSkill as $list)
                            <li>{{ $list }}</li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </section>
            @endisset

            @isset($data['education'])
            <section id="educations" class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-green-700 border-b-2 border-green-500 pb-2 mb-4">Educations</h2>
                @foreach ($data['education'] as $edu)
                <div class="mb-6">
                    <h4 class="text-xl font-semibold text-gray-900 mb-1">{{ $edu['degree'] ?? 'N/A' }}@isset($edu['field_of_study']), {{ $edu['field_of_study'] }}@endisset</h4>
                    <div class="text-base">
                        {{ $edu['institution'] ?? '' }}@isset($edu['location']), {{ $edu['location'] }}@endisset |
                        {{ $edu['start_date'] ?? '' }} - {{ $edu['end_date'] ?? '' }}
                        @isset($edu['gpa']) | GPA: {{ $edu['gpa'] }}@endisset
                    </div>
                </div>
                @endforeach
            </section>
            @endisset

            @isset($data['experience'])
            <section class="mb-8 pb-5 border-b border-gray-200">
                <h3 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-5 border-l-4 border-green-600 pl-4">Experience</h3>
                @foreach ($data['experience'] as $job)
                <div class="mb-6 p-4 bg-gray-50 border-l-4 border-green-600 rounded-md shadow-sm">
                    <h4 class="text-xl font-semibold text-gray-900 mb-1">{{ $job['title'] ?? 'N/A' }}</h4>
                    <div class="text-gray-700 text-base mb-2">
                        {{ $job['company'] ?? '' }}@isset($job['location']), {{ $job['location'] }}@endisset |
                        {{ $job['start_date'] ?? '' }} - {{ $job['end_date'] ?? '' }}
                    </div>
                    @isset($job['responsibilities'])
                    <ul class="list-disc ml-5 text-gray-700">
                        @foreach ($job['responsibilities'] as $responsibility)
                        <li class="mb-1">{{ $responsibility }}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                @endforeach
            </section>
            @endisset

            @isset($data['skills'])
            <section class="mb-8 pb-5 border-b border-gray-200">
                <h3 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-5 border-l-4 border-green-600 pl-4">Skills</h3>
                @foreach ($data['skills'] as $category => $skillList)
                <h4 class="text-xl font-semibold text-gray-800 mb-3">{{ Str::title(str_replace('_', ' ', $category)) }}</h4>
                <div class="flex flex-wrap gap-3 mb-5">
                    @foreach ($skillList as $skill)
                    <span class="bg-blue-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap shadow-sm">
                        {{ $skill }}
                    </span>
                    @endforeach
                </div>
                @endforeach
            </section>
            @endisset

        </main>
        <footer class="text-center text-gray-500 text-sm mt-8 py-4 border-t border-gray-200">
            <p>&copy; {{ date('Y') }} For inquiries, please connect with me through my blog: <a href="{!! url(" https://mohamad-amujaki.blogspot.com") !!}" target="_blank" class="text-blue-600 hover:underline">Jaki's' Insight</a></p>
        </footer>
    </div>
</body>

</html>
