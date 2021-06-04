<x-guest-layout>
    <div class="overflow-x-hidden antialiased">
        <header class="relative z-50 w-full h-24">
            <div class="container flex items-center justify-center h-full max-w-6xl px-8 mx-auto sm:justify-between xl:px-0">
                <a class="relative flex items-center inline-block h-5 h-full font-black leading-none"
                    href="{{ url('/') }}">
                    <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="13.5" cy="13.5" r="12" stroke="#4FA1FC" stroke-width="3"/>
                        <circle cx="8.26525" cy="13.5" r="0.877551" fill="#4FA1FC" stroke="#4FA1FC"/>
                        <circle cx="13.5" cy="13.4999" r="0.877551" fill="#4FA1FC" stroke="#4FA1FC"/>
                        <circle cx="18.7347" cy="13.4999" r="0.877551" fill="#4FA1FC" stroke="#4FA1FC"/>
                    </svg>
                    <span class="ml-3 text-xl text-gray-800">Laporin</span>
                </a>
                <nav id="nav" class="absolute top-0 left-0 z-50 flex flex-col items-center justify-between hidden w-full h-24 pt-5 mt-24 text-sm text-gray-800 bg-white border-t border-b border-gray-200 md:w-auto md:flex-row md:h-24 lg:text-base md:bg-transparent md:mt-0 md:border-none md:py-0 md:flex md:relative">
                    @if (Route::has('login'))
                    @auth
                    <a class="ml-0 mr-0 font-bold duration-100 md:ml-12 md:mr-3 lg:mr-8 transition-color hover:text-blue-400"
                        href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                    <a class="py-2 mr-0 font-bold duration-100 md:ml-12 md:mr-3 lg:mr-8 transition-color hover:text-blue-400"
                        href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                    <a class="py-3 mr-0 font-bold duration-100 md:ml-12 md:mr-3 lg:mr-8 transition-color hover:text-blue-400"
                        href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </nav>
                <div id="nav-mobile-btn"
                    class="absolute top-0 right-0 z-50 block w-6 mt-8 mr-10 cursor-pointer select-none md:hidden sm:mt-10">
                <span class="block w-full h-1 mt-2 duration-200 transform bg-gray-800 rounded-full sm:mt-1"></span>
                <span class="block w-full h-1 mt-1 duration-200 transform bg-gray-800 rounded-full"></span>
            </div>
            </div>
            @endif
        </header>
        <main class="relative items-center justify-center w-full overflow-x-hidden lg:pt-20 lg:pb-20 xl:pt-20 xl:pb-64">
            <div class="container flex flex-col items-center justify-between h-full max-w-6xl px-8 mx-auto -mt-32 lg:flex-row xl:px-0">
                <div class="z-30 flex flex-col items-center w-full max-w-xl pt-48 text-center lg:items-start lg:w-1/2 lg:pt-20 xl:pt-40 lg:text-left">
                    <h1 class="relative mb-4 text-3xl font-black leading-tight text-gray-900 sm:text-6xl xl:mb-8">
                        Build Your Amazing Experience with Us!<!-- Google Bangkit Capstone Project B21-CAP0330 -->
                    </h1>
                    <p class="pr-0 mb-8 text-base text-gray-600 sm:text-lg xl:text-xl lg:pr-20">
                        We are ready to accommodate and forward your complaint to the right party.
                    </p>
                    <a class="relative self-start inline-block w-auto px-8 py-4 mx-auto mt-0 text-base font-bold text-white bg-blue-400 border-t border-gray-200 rounded-md shadow-xl sm:mt-1 fold-bold lg:mx-0"
                        href="https://storage.googleapis.com/backend-service-bucket/app-release.apk"
                        target="_blank">
                        Download APK
                    </a>
                    <div class="flex-col hidden mt-12 sm:flex lg:mt-24">
                        <p class="mb-4 text-sm font-medium tracking-widest text-gray-500 uppercase">
                            Check our links
                        </p>
                        <div class="flex">
                            <a href="https://github.com/laporin" target="_blank">
                                <svg class="h-8 mr-4 text-gray-500 duration-150 cursor-pointer fill-current transition-color hover:text-gray-600"
                                    viewBox="0 0 2350 2315"
                                    xmlns="http://www.w3.org/2000/-svg"
                                    >
                                <g stroke="none" stroke-width="1">
                                    <g>
                                        <path d="M1175 0C525.8 0 0 525.8 0 1175c0 552.2 378.9 1010.5 890.1 1139.7-5.9-14.7-8.8-35.3-8.8-55.8v-199.8H734.4c-79.3 0-152.8-35.2-185.1-99.9-38.2-70.5-44.1-179.2-141-246.8-29.4-23.5-5.9-47 26.4-44.1 61.7 17.6 111.6 58.8 158.6 120.4 47 61.7 67.6 76.4 155.7 76.4 41.1 0 105.7-2.9 164.5-11.8 32.3-82.3 88.1-155.7 155.7-190.9-393.6-47-581.6-240.9-581.6-505.3 0-114.6 49.9-223.3 132.2-317.3-26.4-91.1-61.7-279.1 11.8-352.5 176.3 0 282 114.6 308.4 143.9 88.1-29.4 185.1-47 284.9-47 102.8 0 196.8 17.6 284.9 47 26.4-29.4 132.2-143.9 308.4-143.9 70.5 70.5 38.2 261.4 8.8 352.5 82.3 91.1 129.3 202.7 129.3 317.3 0 264.4-185.1 458.3-575.7 499.4 108.7 55.8 185.1 214.4 185.1 331.9V2256c0 8.8-2.9 17.6-2.9 26.4C2021 2123.8 2350 1689.1 2350 1175 2350 525.8 1824.2 0 1175 0z" />
                                    </g>
                                </g>
                            </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <img src="https://storage.googleapis.com/backend-service-bucket/laporin_android.png"
                    alt="Laporin-Android" height="450" width="250"
                    class="mt-10 lg:mt-15">
            </div>
        </main>
    </div>
    <script>
        if (document.getElementById('nav-mobile-btn')) {
            document.getElementById('nav-mobile-btn').addEventListener('click', function () {
                if (this.classList.contains('close')) {
                    document.getElementById('nav').classList.add('hidden');
                    this.classList.remove('close');
                } else {
                    document.getElementById('nav').classList.remove('hidden');
                    this.classList.add('close');
                }
            });
        }
    </script>
</x-guest-layout>
