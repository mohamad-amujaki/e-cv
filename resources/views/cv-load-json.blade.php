<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['personal']['name'] ?? 'Curriculum Vitae' }}</title>
    {{-- CDN Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- Sertakan Tailwind CSS Anda. Gunakan @vite untuk Laravel 9+ atau link mix() untuk versi lama --}}
    @vite('resources/css/app.css')

</head>

<body class="font-sans antialiased bg-gray-100 text-gray-800 leading-relaxed text-base">
    <div class="max-w-4xl mx-auto my-8 bg-white rounded-lg shadow-xl p-8 md:p-10 lg:p-12">

        {{-- Bagian Header (Informasi Pribadi) --}}
        @isset($data['personal'])
        <header class="text-center mb-10">
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-1">{{ $data['personal']['name'] }}</h1>
            <h2 class="text-xl lg:text-2xl font-medium text-blue-600 mt-1">{{ $data['personal']['title'] }}</h2>

            <div class="flex flex-wrap justify-center gap-x-6 gap-y-3 mt-5 text-gray-600">
                @isset($data['personal']['email'])
                <div class="flex items-center gap-2">
                    <i class="fas fa-envelope text-blue-600"></i>
                    <a href="mailto:{{ $data['personal']['email'] }}" class="hover:underline">{{ $data['personal']['email'] }}</a>
                </div>
                @endisset
                @isset($data['personal']['phone'])
                <div class="flex items-center gap-2">
                    <i class="fas fa-phone-alt text-blue-600"></i>
                    <a href="tel:{{ $data['personal']['phone'] }}" class="hover:underline">{{ $data['personal']['phone'] }}</a>
                </div>
                @endisset
                @isset($data['personal']['location'])
                <div class="flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                    <span>{{ $data['personal']['location'] }}</span>
                </div>
                @endisset
            </div>
        </header>
        @endisset

        {{-- Bagian Link Sosial --}}
        @isset($data['social_links'])
        <div class="text-center mb-10">
            @foreach ($data['social_links'] as $link)
            @isset($link['url'])
            <a href="{{ $link['url'] }}" target="_blank" title="{{ $link['platform'] }}" class="inline-block mx-3 text-blue-600 text-3xl hover:text-blue-800 transition duration-300">
                <i class="{{ $link['icon_class'] ?? 'fas fa-link' }}"></i>
            </a>
            @endisset
            @endforeach
        </div>
        @endisset

        <div class="text-center mb-6">
            <a href="{{ route('cv.download') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150" target="_blank">
                <i class="fas fa-file-pdf mr-2"></i>
                Download CV (PDF)
            </a>
        </div>

        {{-- Bagian Ringkasan --}}
        @isset($data['personal']['summary'])
        <section class="mb-8 pb-5 border-b border-gray-200">
            <h3 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-5 border-l-4 border-blue-600 pl-4">Summary</h3>
            <p class="text-justify text-lg text-gray-700">{!! nl2br(e($data['personal']['summary'])) !!}</p>
        </section>
        @endisset

        {{-- Bagian Pengalaman --}}
        @isset($data['experience'])
        <section class="mb-8 pb-5 border-b border-gray-200">
            <h3 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-5 border-l-4 border-blue-600 pl-4">Experience</h3>
            @foreach ($data['experience'] as $job)
            <div class="mb-6 p-4 bg-gray-50 border-l-4 border-blue-600 rounded-md shadow-sm">
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

        {{-- Bagian Pendidikan --}}
        @isset($data['education'])
        <section class="mb-8 pb-5 border-b border-gray-200">
            <h3 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-5 border-l-4 border-blue-600 pl-4">Education</h3>
            @foreach ($data['education'] as $edu)
            <div class="mb-6 p-4 bg-gray-50 border-l-4 border-blue-600 rounded-md shadow-sm">
                <h4 class="text-xl font-semibold text-gray-900 mb-1">{{ $edu['degree'] ?? 'N/A' }}@isset($edu['field_of_study']), {{ $edu['field_of_study'] }}@endisset</h4>
                <div class="text-gray-700 text-base">
                    {{ $edu['institution'] ?? '' }}@isset($edu['location']), {{ $edu['location'] }}@endisset |
                    {{ $edu['start_date'] ?? '' }} - {{ $edu['end_date'] ?? '' }}
                    @isset($edu['gpa']) | GPA: {{ $edu['gpa'] }}@endisset
                </div>
            </div>
            @endforeach
        </section>
        @endisset

        {{-- Bagian Skill --}}
        @isset($data['skills'])
        <section class="mb-8 pb-5 border-b border-gray-200">
            <h3 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-5 border-l-4 border-blue-600 pl-4">Skills</h3>
            @foreach ($data['skills'] as $category => $skillList)
            <h4 class="text-xl font-semibold text-gray-800 mb-3">{{ Str::title(str_replace('_', ' ', $category)) }}</h4>
            <div class="flex flex-wrap gap-3 mb-5">
                @foreach ($skillList as $skill)
                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap shadow-sm">
                    {{ $skill }}
                </span>
                @endforeach
            </div>
            @endforeach
        </section>
        @endisset

        {{-- Bagian Proyek --}}
        @isset($data['projects'])
        <section class="mb-8 pb-5">
            <h3 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-5 border-l-4 border-blue-600 pl-4">Projects</h3>
            @foreach ($data['projects'] as $project)
            <div class="mb-6 p-4 bg-gray-50 border-l-4 border-blue-600 rounded-md shadow-sm">
                <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $project['name'] ?? 'N/A' }}</h4>
                @isset($project['description'])
                <p class="text-gray-700 mb-2">{{ $project['description'] }}</p>
                @endisset
                @isset($project['technologies'])
                <p class="text-gray-600 italic text-sm mb-3">
                    <strong>Technologies:</strong> {{ implode(', ', $project['technologies']) }}
                </p>
                @endisset
                <div class="flex gap-4">
                    @isset($project['url'])
                    @if($project['url'] !== null)
                    <a href="{{ $project['url'] }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium hover:underline">
                        <i class="fas fa-external-link-alt mr-1"></i> View Project
                    </a>
                    @endif
                    @endisset
                    @isset($project['github_url'])
                    <a href="{{ $project['github_url'] }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium hover:underline">
                        <i class="fab fa-github mr-1"></i> GitHub
                    </a>
                    @endisset
                </div>
            </div>
            @endforeach
        </section>
        @endisset
    </div>
</body>

</html>
