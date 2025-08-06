<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuclear Energy vs Renewables - Factly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .ai-badge {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        .pro-glow { box-shadow: 0 0 20px rgba(34, 197, 94, 0.2); }
        .con-glow { box-shadow: 0 0 20px rgba(239, 68, 68, 0.2); }
        .tooltip {
            position: relative;
            display: inline-block;
        }
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #1f2937;
            color: #fff;
            text-center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 12px;
            line-height: 1.4;
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header - Matching your layout -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/presentation/homepage" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-balance-scale text-white text-sm"></i>
                    </div>
                    <span class="text-2xl font-semibold text-gray-900">Factly</span>
                </a>

                <!-- Navigation -->
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Home
                    </a>
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
                        Discussions
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Polls
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Categories
                    </a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-1"></i> New Discussion
                    </button>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 text-xs font-medium">AJ</span>
                        </div>
                        <span class="text-sm text-gray-700 hidden sm:block">Alex Johnson</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Topic Header -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">Science</span>
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-medium">Environment</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        Should nuclear energy be prioritized over renewable sources for climate goals?
                    </h1>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        With climate targets becoming increasingly urgent, the debate between nuclear and renewable energy intensifies. Nuclear provides consistent baseload power but raises safety concerns, while renewables are clean but intermittent. This discussion examines the evidence for prioritizing one approach over the other in meeting global climate commitments.
                    </p>
                    <div class="flex items-center space-x-6 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-user mr-2"></i> Started by Dr. Sarah Chen
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-2"></i> 2 hours ago
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-eye mr-2"></i> 2,847 views
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-comments mr-2"></i> 23 arguments
                        </span>
                        <button onclick="openReportModal('discussion')" class="flex items-center text-red-600 hover:text-red-800 transition-colors">
                            <i class="fas fa-flag mr-1"></i> Report
                        </button>
                    </div>
                </div>
                <div class="ml-8">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-atom text-white text-5xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Arguments Section -->
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Pro Arguments -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <h2 class="text-2xl font-bold text-green-600">Supporting Arguments</h2>
                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-sm font-medium">12</span>
                    </div>
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-plus mr-1"></i> Add Pro
                    </button>
                </div>

                <!-- Pro Argument 1 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover pro-glow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-plus text-green-600"></i>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-900">Dr. Michael Thomson</span>
                                <div class="text-xs text-gray-500">Energy Policy Researcher</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="text-blue-600 hover:text-blue-800 text-xs" title="Edit argument">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="openReportModal('argument-pro1')" class="text-red-600 hover:text-red-800 text-xs" title="Report argument">
                                <i class="fas fa-flag"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 text-xs" title="Delete argument">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Nuclear power plants have a capacity factor of 90-95%, providing consistent baseload energy regardless of weather conditions. France generates 70% of its electricity from nuclear power with one of the lowest carbon footprints in Europe (58g CO2/kWh vs global average of 475g CO2/kWh).
                    </p>

                    <div class="flex items-center justify-between text-sm border-t pt-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-xs text-gray-500 ml-2">Dr. Michael Thomson</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button"
                                data-modal-target="reference-modal-pro1"
                                data-modal-toggle="reference-modal-pro1"
                                class="flex items-center text-blue-600 hover:underline text-xs">
                                <i class="fas fa-link mr-1"></i> References
                            </button>
                            <span class="text-xs text-gray-400">(4)</span>

                            <div class="flex items-center">
                                <i class="fas fa-thumbs-up cursor-pointer text-green-500 text-xs"></i>
                                <span class="text-xs ml-1">47</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Pro Argument 2 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover pro-glow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-plus text-green-600"></i>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-900">Lisa Martinez</span>
                                <div class="text-xs text-gray-500">Climate Scientist</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="openReportModal('argument-pro2')" class="text-red-600 hover:text-red-800 text-xs" title="Report argument">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Nuclear energy has prevented approximately 1.84 million air pollution-related deaths globally since 1971. Modern reactors like Generation III+ designs have passive safety systems that shut down automatically without human intervention, significantly reducing accident risks.
                    </p>

                    <div class="flex items-center justify-between text-sm border-t pt-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-xs text-gray-500 ml-2">Lisa Martinez</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button"
                                data-modal-target="reference-modal-pro2"
                                data-modal-toggle="reference-modal-pro2"
                                class="flex items-center text-blue-600 hover:underline text-xs">
                                <i class="fas fa-link mr-1"></i> References
                            </button>
                            <span class="text-xs text-gray-400">(6)</span>

                            <div class="flex items-center">
                                <i class="fas fa-thumbs-up cursor-pointer text-green-500 text-xs"></i>
                                <span class="text-xs ml-1">32</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Pro Argument 3 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover pro-glow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-plus text-green-600"></i>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-900">Prof. James Walker</span>
                                <div class="text-xs text-gray-500">Nuclear Engineering</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="openReportModal('argument-pro3')" class="text-red-600 hover:text-red-800 text-xs" title="Report argument">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Nuclear plants require minimal land use compared to renewables. A single nuclear plant can generate as much electricity as thousands of wind turbines, requiring 360 times less land area than wind farms for equivalent power output.
                    </p>

                    <div class="flex items-center justify-between text-sm border-t pt-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-xs text-gray-500 ml-2">Prof. James Walker</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button"
                                data-modal-target="reference-modal-pro3"
                                data-modal-toggle="reference-modal-pro3"
                                class="flex items-center text-blue-600 hover:underline text-xs">
                                <i class="fas fa-link mr-1"></i> References
                            </button>
                            <span class="text-xs text-gray-400">(2)</span>

                            <div class="tooltip">
                                <i class="fas fa-robot text-purple-600 text-xs cursor-help"></i>
                                <span class="tooltiptext">
                                    AI verified: References support the argument
                                </span>
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-thumbs-up cursor-pointer text-green-500 text-xs"></i>
                                <span class="text-xs ml-1">28</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Con Arguments -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <h2 class="text-2xl font-bold text-red-600">Counter Arguments</h2>
                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-sm font-medium">11</span>
                    </div>
                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-plus mr-1"></i> Add Con
                    </button>
                </div>

                <!-- Con Argument 1 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover con-glow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-minus text-red-600"></i>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-900">Dr. Emma Rodriguez</span>
                                <div class="text-xs text-gray-500">Renewable Energy Expert</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="openReportModal('argument-con1')" class="text-red-600 hover:text-red-800 text-xs" title="Report argument">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Renewable energy costs have plummeted by 70-85% since 2010, making solar and wind the cheapest sources of electricity in most regions. Nuclear construction costs have increased dramatically, with projects like Vogtle and Hinkley Point C experiencing massive cost overruns and delays.
                    </p>

                    <div class="flex items-center justify-between text-sm border-t pt-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-xs text-gray-500 ml-2">Dr. Emma Rodriguez</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button"
                                data-modal-target="reference-modal-con1"
                                data-modal-toggle="reference-modal-con1"
                                class="flex items-center text-blue-600 hover:underline text-xs">
                                <i class="fas fa-link mr-1"></i> References
                            </button>
                            <span class="text-xs text-gray-400">(7)</span>

                            <div class="tooltip">
                                <i class="fas fa-robot text-purple-600 text-xs cursor-help"></i>
                                <span class="tooltiptext">
                                    AI verified: References support the argument
                                </span>
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-thumbs-up cursor-pointer text-red-500 text-xs"></i>
                                <span class="text-xs ml-1">39</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Con Argument 2 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover con-glow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-minus text-red-600"></i>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-900">Marcus Chen</span>
                                <div class="text-xs text-gray-500">Environmental Policy</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="openReportModal('argument-con2')" class="text-red-600 hover:text-red-800 text-xs" title="Report argument">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Nuclear waste remains radioactive for thousands of years with no permanent disposal solution implemented globally. The Fukushima disaster demonstrated that even modern plants can fail catastrophically, requiring massive exclusion zones and decades of cleanup costing hundreds of billions.
                    </p>

                    <div class="flex items-center justify-between text-sm border-t pt-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-xs text-gray-500 ml-2">Marcus Chen</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button"
                                data-modal-target="reference-modal-con2"
                                data-modal-toggle="reference-modal-con2"
                                class="flex items-center text-blue-600 hover:underline text-xs">
                                <i class="fas fa-link mr-1"></i> References
                            </button>
                            <span class="text-xs text-gray-400">(5)</span>

                            <div class="tooltip">
                                <i class="fas fa-robot text-purple-600 text-xs cursor-help"></i>
                                <span class="tooltiptext">
                                    AI verified: References support the argument
                                </span>
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-thumbs-up cursor-pointer text-red-500 text-xs"></i>
                                <span class="text-xs ml-1">35</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Con Argument 3 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover con-glow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-minus text-red-600"></i>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-900">Sarah Kim</span>
                                <div class="text-xs text-gray-500">Energy Systems Analyst</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="openReportModal('argument-con3')" class="text-red-600 hover:text-red-800 text-xs" title="Report argument">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-gray-700 mb-4 leading-relaxed">
                        Battery storage technology is rapidly advancing, making renewable intermittency manageable. Countries like Denmark generate 140% of their electricity needs from wind, exporting excess. Smart grids and demand response can balance renewable variability more cost-effectively than nuclear baseload.
                    </p>

                    <div class="flex items-center justify-between text-sm border-t pt-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-xs text-gray-500 ml-2">Sarah Kim</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button"
                                data-modal-target="reference-modal-con3"
                                data-modal-toggle="reference-modal-con3"
                                class="flex items-center text-blue-600 hover:underline text-xs">
                                <i class="fas fa-link mr-1"></i> References
                            </button>
                            <span class="text-xs text-gray-400">(8)</span>

                            <div class="tooltip">
                                <i class="fas fa-robot text-purple-600 text-xs cursor-help"></i>
                                <span class="tooltiptext">
                                    AI verified: References support the argument
                                </span>
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-thumbs-up cursor-pointer text-red-500 text-xs"></i>
                                <span class="text-xs ml-1">42</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-8">
            <button class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                Load More Arguments
            </button>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-balance-scale text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold">Factly</span>
                </div>
                <div class="text-sm text-gray-400 text-center md:text-right">
                    © 2025 Factly. Building the future of evidence-based discourse.
                </div>
            </div>
        </div>
    </footer>

    <!-- Reference Modals -->
    <!-- Pro Argument 1 References -->
    <div id="reference-modal-pro1" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-blue-800">References</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="reference-modal-pro1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                World Nuclear Association - Nuclear Power Capacity Factors
                            </a>
                            <button onclick="openReportModal('reference-pro1-1')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (94% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                IEA Energy Statistics - France Carbon Intensity
                            </a>
                            <button onclick="openReportModal('reference-pro1-2')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (89% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pro Argument 2 References -->
    <div id="reference-modal-pro2" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-blue-800">References</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="reference-modal-pro2">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                NASA Study - Nuclear Energy Deaths Prevented
                            </a>
                            <button onclick="openReportModal('reference-pro2-1')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (92% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                Generation III+ Reactor Safety Systems
                            </a>
                            <button onclick="openReportModal('reference-pro2-2')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (87% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pro Argument 3 References -->
    <div id="reference-modal-pro3" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-blue-800">References</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="reference-modal-pro3">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                Land Use Comparison - Nuclear vs Wind
                            </a>
                            <button onclick="openReportModal('reference-pro3-1')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Source not in trusted list" class="text-orange-500 text-xs">⚠️ Unverified</span>
                            <span title="Relevant to claim (78% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Con Argument 1 References -->
    <div id="reference-modal-con1" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-blue-800">References</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="reference-modal-con1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                IRENA Global Energy Cost Analysis 2023
                            </a>
                            <button onclick="openReportModal('reference-con1-1')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (96% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                Vogtle Nuclear Plant Cost Overruns Report
                            </a>
                            <button onclick="openReportModal('reference-con1-2')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (91% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Con Argument 2 References -->
    <div id="reference-modal-con2" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-blue-800">References</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="reference-modal-con2">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                Nuclear Waste Storage - Current Status
                            </a>
                            <button onclick="openReportModal('reference-con2-1')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (93% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                Fukushima Disaster Economic Impact
                            </a>
                            <button onclick="openReportModal('reference-con2-2')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (88% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Con Argument 3 References -->
    <div id="reference-modal-con3" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md mx-auto">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-blue-800">References</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="reference-modal-con3">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                Denmark Wind Energy Export Statistics
                            </a>
                            <button onclick="openReportModal('reference-con3-1')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (95% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                            <span title="AI verified: This reference supports the argument" class="text-purple-600 text-xs cursor-help">🤖 AI Verified</span>
                        </div>
                    </div>
                    <div class="border-b pb-2 mb-2">
                        <div class="flex items-center mb-1">
                            <a href="#" target="_blank" class="text-blue-600 underline flex-1">
                                Battery Storage Technology Trends 2024
                            </a>
                            <button onclick="openReportModal('reference-con3-2')" class="ml-2 text-red-600 hover:text-red-800 text-xs" title="Report reference">
                                <i class="fas fa-flag"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                            <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                            <span title="Relevant to claim (89% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Report Content</h2>
                        <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                            <span class="text-sm text-yellow-700">Help us maintain quality discussions by reporting inappropriate content.</span>
                        </div>
                    </div>

                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">What are you reporting? <span class="text-red-500">*</span></label>
                            <div id="reportContext" class="text-sm text-gray-600 mb-3 p-2 bg-gray-50 rounded">
                                <!-- This will be populated dynamically -->
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reason for reporting <span class="text-red-500">*</span></label>
                            <select id="reportReason" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                                <option value="">Please select a reason</option>
                                <option value="spam">Spam or misleading content</option>
                                <option value="inappropriate">Inappropriate or offensive content</option>
                                <option value="misinformation">False or unverified information</option>
                                <option value="harassment">Harassment or bullying</option>
                                <option value="copyright">Copyright violation</option>
                                <option value="irrelevant">Off-topic or irrelevant</option>
                                <option value="low-quality">Low quality or poorly sourced</option>
                                <option value="duplicate">Duplicate content</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Additional details</label>
                            <textarea id="reportDetails" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Please provide any additional context that will help our moderators understand your report..."></textarea>
                        </div>

                        <div class="text-xs text-gray-500 bg-gray-50 p-3 rounded">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Your report will be reviewed by our moderation team. False reports may result in account restrictions.
                        </div>
                    </form>

                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                        <button onclick="closeReportModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </button>
                        <button onclick="submitReport()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Submit Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentReportTarget = null;
        let reportTypes = {
            'discussion': 'Main Discussion Topic',
            'argument-pro1': 'Pro Argument by Dr. Michael Thomson',
            'argument-pro2': 'Pro Argument by Lisa Martinez',
            'argument-pro3': 'Pro Argument by Prof. James Walker',
            'argument-con1': 'Counter Argument by Dr. Emma Rodriguez',
            'argument-con2': 'Counter Argument by Marcus Chen',
            'argument-con3': 'Counter Argument by Sarah Kim',
            'reference-pro1-1': 'Reference: World Nuclear Association',
            'reference-pro1-2': 'Reference: IEA Energy Statistics',
            'reference-pro2-1': 'Reference: NASA Study',
            'reference-pro2-2': 'Reference: Generation III+ Reactor Safety',
            'reference-pro3-1': 'Reference: Land Use Comparison',
            'reference-con1-1': 'Reference: IRENA Global Energy Cost Analysis',
            'reference-con1-2': 'Reference: Vogtle Nuclear Plant Report',
            'reference-con2-1': 'Reference: Nuclear Waste Storage',
            'reference-con2-2': 'Reference: Fukushima Disaster Impact',
            'reference-con3-1': 'Reference: Denmark Wind Energy Statistics',
            'reference-con3-2': 'Reference: Battery Storage Technology Trends'
        };

        function openReportModal(targetId) {
            currentReportTarget = targetId;

            // Update the context display
            const contextDiv = document.getElementById('reportContext');
            const targetDescription = reportTypes[targetId] || 'Unknown Content';
            contextDiv.innerHTML = `<i class="fas fa-flag text-red-500 mr-2"></i>Reporting: <strong>${targetDescription}</strong>`;

            // Reset form
            document.getElementById('reportReason').value = '';
            document.getElementById('reportDetails').value = '';

            // Show modal
            document.getElementById('reportModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentReportTarget = null;
        }

        function submitReport() {
            const reason = document.getElementById('reportReason').value;
            const details = document.getElementById('reportDetails').value;

            // Validate required fields
            if (!reason) {
                alert('Please select a reason for your report.');
                return;
            }

            // Here you would normally send the report to your backend
            const reportData = {
                targetId: currentReportTarget,
                targetType: reportTypes[currentReportTarget],
                reason: reason,
                details: details,
                timestamp: new Date().toISOString()
            };

            console.log('Report submitted:', reportData);

            // Show success message
            const successMessage = reason === 'other' && details.trim() === ''
                ? 'Report submitted successfully. Please note that providing additional details helps our moderation team.'
                : 'Report submitted successfully. Thank you for helping us maintain quality discussions.';

            alert(successMessage);
            closeReportModal();
        }

        // Close modal when clicking outside
        document.getElementById('reportModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReportModal();
            }
        });

        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('reportModal').classList.contains('hidden')) {
                closeReportModal();
            }
        });

        // Show additional details field when "Other" is selected
        document.getElementById('reportReason').addEventListener('change', function() {
            const detailsContainer = document.getElementById('reportDetails');
            const label = detailsContainer.previousElementSibling;

            if (this.value === 'other') {
                label.innerHTML = 'Additional details <span class="text-red-500">*</span>';
                detailsContainer.setAttribute('required', 'required');
                detailsContainer.placeholder = 'Please specify the reason for your report...';
            } else {
                label.innerHTML = 'Additional details';
                detailsContainer.removeAttribute('required');
                detailsContainer.placeholder = 'Please provide any additional context that will help our moderators understand your report...';
            }
        });
    </script>

</body>
</html>
