@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <!-- Banner Section -->
        <div class="relative w-full h-64 md:h-80 flex items-center justify-center"
            style="background-image: url('https://i.ibb.co/k6gYnkK9/Whats-App-Image-2025-09-18-at-11-39-37-AM-2.jpg'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/40 to-blue-400/40">
            </div>
            <h1 class="relative text-white text-2xl font-bold text-center drop-shadow-lg z-10">
                Welcome to Bangladesh Technical Education Institute
            </h1>
        </div>
        <!-- Notice & Marquee Section (Single Line, Red Background) -->
        <div
            class="bg-red-500 text-white font-bold px-4 py-2 mb-4 shadow-md text-center flex items-center justify-center overflow-hidden">
            <div class="w-16 h-full bg-red-500 ml-8 z-10 px-2">
                <span>নোটিশ</span>
            </div>
            <span class="overflow-hidden whitespace-nowrap animate-marquee">
                Admission is open for new session! | Check your results online | Verified institutes list updated |
                Contact us for more information.
            </span>
        </div>
        <style>
            @keyframes marquee {
                0% {
                    transform: translateX(100%);
                }

                100% {
                    transform: translateX(-100%);
                }
            }

            .animate-marquee {
                display: inline-block;
                min-width: 100%;
                animation: marquee 18s linear infinite;
            }
        </style>
    </div>

    <div class="container mx-auto px-4 py-4">
        <div class="w-full md:w-1/2 mx-auto bg-gray-200 rounded-lg shadow-md overflow-hidden border">
            <div class="flex flex-col md:flex-row items-center">
                <img src="https://i.ibb.co.com/pBZZRPfv/Bangladesh-orthographic-projection-svg.png" alt=""
                    class="w-32 h-32 object-contain m-4">
                <div class="flex-1 p-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 text-center md:text-left">নোটিশ বোর্ড</h2>
                    <ul class="text-gray-700 text-sm space-y-2 list-none">
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                            নমুনা ফক মোতাহেরক বাযারীক ও অন্যান্য বিষয়ের প্রতিবেদন প্রকল্পকল্প প্রকল্প
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                            জাতীয় সংস্করণ: (সক্ক ৫:৩০ ঘন্টা) শলমদের জানুয়ারি জুন ও এপ্রিল লুন, ২০২৫ সেপ্তেম...
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                            জাতীয় সংস্করণ: (সক্ক ৫:৩০ ঘন্টা) শলমদের জুলাই জুন, ২০২৫ সেপ্তেম চুয়ান ...
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                            চিরোয়াল-ই-উটিলিন ইলেকট্রিক শিক্ষামোয়র ৯ম পেরেই ইলেকট্রিক স্টেশন এড পা,
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-2 flex-shrink-0"></span>
                            চিরোয়াল ইন চেস্টার: হার্টসারি, এশিয়ানগান, শিলাসুর, নাহরতদ ও দরবারন শিক্ষা...
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8 flex flex-col md:items-start items-center bg-white mt-6">
        <h2 class="text-4xl md:text-6xl font-bold text-gray-800 mb-6 text-center md:text-left w-full max-w-2xl">
            Build your future with <span class="text-blue-600">skills</span>, not just degrees.
        </h2>
        <div class="flex flex-col md:flex-row w-full items-center md:items-center mb-6 gap-2">
            <div class="flex w-full md:w-auto justify-center">
                <img src="https://i.ibb.co/FqyJFwnH/Whats-App-Image-2025-09-07-at-9-25-05-AM.jpg" alt=""
                    class="w-14 h-14 object-cover transition-transform duration-200 hover:scale-105 rounded-full border-2 border-white">
                <img src="https://i.ibb.co/svLW3g2r/Whats-App-Image-2025-09-07-at-9-25-21-AM.jpg" alt=""
                    class="w-14 h-14 object-cover transition-transform duration-200 hover:scale-105 rounded-full border-2 border-white -ml-4">
                <img src="https://media.istockphoto.com/id/1500076821/photo/happy-black-teenage-girl-in-high-school-hallway-looking-at-camera.jpg?s=612x612&w=0&k=20&c=Kc1x5IRZz7dqtUNt8k3zFB6ZKJz4CIiT-tbB0FFmAww="
                    alt=""
                    class="w-14 h-14 object-cover transition-transform duration-200 hover:scale-105 rounded-full border-2 border-white -ml-4">
            </div>
            <p class="text-gray-600 text-lg mb-6 text-center">
                Join our <span class="font-semibold text-blue-500">1600+ students</span>. Your Future Begins Here –
                Learn, Grow, Succeed.
            </p>
        </div>
        <a href="#"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow transition">
            Get Started
        </a>
    </div>
    <style>
        .flex img:hover {
            z-index: 1;
        }
    </style>

    <div class="container mx-auto px-4 py-4">
        <div class="bg-blue-950 rounded-md w-full grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
            <div class="h-fit border border-indigo-600 rounded-md overflow-hidden flex items-center justify-center">
                <img src="https://i.ibb.co.com/Df7Wz0XP/629af85d-e71f-4844-99d2-e4f4cd6fd1c5.jpg" alt="">
            </div>
            <div class="flex flex-col items-left text-left md:px-4 px-0 col-span-2">
                <span class="md:text-xl text-lg text-[#7C86FF] font-semibold">প্রতিষ্ঠান পরিচিতি</span>
                <p class="md:text-lg text-md text-white mt-1 mb-1 leading-relaxed">
                    আমরা একটি সরকার অনুমোদিত আধুনিক কারিগরি শিক্ষা ইনস্টিটিউট, যেখানে বিভিন্ন ক্ষেত্রে নানা প্রশিক্ষণ
                    দেয়া হয়, যেমন কম্পিউটার ও বহুভাষিক প্রশিক্ষণ। আমাদের প্রাতিষ্ঠানিক শিক্ষকগণ খুবই যোগ্য। আমাদের
                    বিজ্ঞান, প্রযুক্তি সরকারী স্বীকৃত ট্রেনিং ইনস্টিটিউট, যারা সেক্টরগুলোকে ভরসা করে। আমাদের
                    শিক্ষার্থীদের সাফল্যই আমাদের গর্ব।
                </p>

                <span class="md:text-xl text-lg text-[#7C86FF] font-semibold mt-1">ভিশনঃ
                </span>
                <p class="md:text-lg text-md text-white mt-1 mb-1 leading-relaxed">
                    আধুনিক প্রযুক্তি ও কারিগরি শিক্ষার মাধ্যমে দক্ষ, আত্মনির্ভরশীল এবং আন্তর্জাতিক মানসম্পন্ন প্রজন্ম
                    তৈরি করা, যারা কর্মক্ষেত্র ও চাহিদামত আত্মকৃত স্থাপন করতে পারবে।
                </p>

                <span class="md:text-xl text-lg text-[#7C86FF] font-semibold mt-1">মিশনঃ</span>
                <p class="md:text-lg text-md text-white mt-1 leading-relaxed">
                    শিক্ষার্থীদের হাতে-কলমে প্রযুক্তিগত প্রশিক্ষণ প্রদান দক্ষ ও অভিজ্ঞ প্রশিক্ষকদের মাধ্যমে প্রাপ্ত
                    শিক্ষা নিশ্চিত করা।
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card 1 -->
            <div class="bg-blue-950 rounded-xl w-full p-6 text-center">
                <div class="flex flex-col justify-center items-center mb-4 gap-2">
                    <span class="text-xl font-semibold text-gray-100">প্রতিষ্ঠান চেয়ারম্যান</span>
                    <span class="text-md text-gray-200">মোঃ সামসুল আলম</span>
                    <img src="https://i.ibb.co/LhXb8PKH/IMG-20250911-WA0050-1.jpg" alt="Chairman"
                        class="object-cover h-60 mt-2 rounded-md">
                </div>
                <button
                    class="openModal py-2 px-4 w-full rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition duration-300"
                    data-name="মোঃ সামসুল আলম" data-img="https://i.ibb.co/LhXb8PKH/IMG-20250911-WA0050-1.jpg"
                    data-content="প্রিয় শিক্ষার্থী, শিক্ষক ও অভিভাবকমণ্ডলী, কারিগরি শিক্ষা আজকের বিশ্বের অপরিহার্য চাহিদা। উন্নত বিশ্বের সাথে তাল মিলিয়ে আমাদের দেশকে এগিয়ে নিতে হলে দক্ষ জনশক্তি গড়ে তোলা একান্ত জরুরি। শুধুমাত্র সাধারণ শিক্ষার মাধ্যমে নয়, হাতে-কলমে ব্যবহারিক জ্ঞান অর্জনের মাধ্যমেই প্রকৃত শিক্ষা সম্পূর্ণ হয়। আমাদের প্রতিষ্ঠান সেই লক্ষ্যকে সামনে রেখে শিক্ষার্থীদের আধুনিক কারিগরি শিক্ষায় দক্ষ করে তুলতে নিরলস কাজ করে যাচ্ছে। এখানে শিক্ষার্থীরা শুধু বইয়ের জ্ঞান নয়, বাস্তব জীবনে প্রয়োগযোগ্য দক্ষতা অর্জন করছে, যা তাদের আত্মনির্ভরশীল করে তুলবে এবং কর্মসংস্থানের সুযোগ সৃষ্টি করবে। প্রত্যেক শিক্ষার্থী যদি নিজের মেধা, পরিশ্রম এবং সততাকে কাজে লাগায়, তবে তারা কেবল নিজেদের ভবিষ্যৎ উজ্জ্বল করতে পারবে না, বরং দেশের অর্থনৈতিক উন্নয়ন ও সমাজ গঠনে গুরুত্বপূর্ণ ভূমিকা পালন করবে। আমি দৃঢ়ভাবে বিশ্বাস করি, কারিগরি শিক্ষার সঠিক বিস্তার ঘটলে আমাদের তরুণ প্রজন্ম আর বেকার থাকবে না। তারা দক্ষ পেশাজীবী হিসেবে নিজেকে প্রতিষ্ঠিত করবে এবং বাংলাদেশকে একটি উন্নত ও সমৃদ্ধ দেশে রূপান্তরিত করতে সহায়তা করবে। আসুন আমরা সকলে মিলে কারিগরি শিক্ষাকে গ্রহণ করি এবং নিজেদের জীবন ও জাতির অগ্রগতিকে আরও গতিশীল করি। — [মো: শামসুল আলম ] চেয়ারম্যান [বাংলাদেশ কারিগরি শিক্ষা ইনস্টিটিউট ]">
                    Details
                </button>
            </div>

            <!-- Card 2 -->
            <div class="bg-blue-950 rounded-xl w-full p-6 text-center">
                <div class="flex flex-col justify-center items-center mb-4 gap-2">
                    <span class="text-xl font-semibold text-gray-100">বিশ্বখ্যাত অর্থনীতিবিদ</span>
                    <span class="text-md text-gray-200">ডঃ মোঃ ইউনুস</span>
                    <img src="https://i.ibb.co/m5GSTHwY/IMG-20250914-WA0300-2.jpg" alt="Dr Yunus"
                        class="object-cover h-60 mt-2 rounded-md">
                </div>
                <button
                    class="openModal py-2 px-4 w-full rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition duration-300"
                    data-name="ডঃ মোঃ ইউনুস" data-img="https://i.ibb.co/m5GSTHwY/IMG-20250914-WA0300-2.jpg"
                    data-content="একজন বিশ্বখ্যাত অর্থনীতিবিদ, সমাজসংস্কারক এবং নোবেল শান্তি পুরস্কারপ্রাপ্ত ব্যক্তিত্ব। তিনি ক্ষুদ্রঋণ ও গ্রামীণ ব্যাংক প্রতিষ্ঠার মাধ্যমে দারিদ্র্য বিমোচন ও নারী ক্ষমতায়নের নতুন দ্বার উন্মোচন করেছেন। তাঁর নেতৃত্বে বাংলাদেশে অর্থনৈতিক উন্নয়নের পাশাপাশি বিশ্ব দরবারে নতুন মর্যাদা অর্জন করেছে। বর্তমানে তিনি বাংলাদেশের অন্তর্বর্তী সরকারের প্রধান হিসেবে দায়িত্ব পালন করছেন। সততা, ন্যায়পরায়ণতা এবং স্বচ্ছতার আদর্শে তিনি দেশকে উন্নত, ন্যায়ভিত্তিক ও মানবিক পথে এগিয়ে নিয়ে যেতে কাজ করছেন। মূল দর্শন: দারিদ্র্যমুক্ত সমাজ গঠন, নারী ও পিছিয়ে পড়া জনগোষ্ঠীর ক্ষমতায়ন, টেকসই উন্নয়ন ও সামাজিক ব্যবসার প্রসার, ন্যায়ভিত্তিক ও স্বচ্ছ শাসন ব্যবস্থা। উল্লেখযোগ্য অর্জন: গ্রামীণ ব্যাংক প্রতিষ্ঠা এবং ক্ষুদ্রঋণ মডেলের বিশ্বব্যাপী প্রসার, নোবেল শান্তি পুরস্কার (২০০৬), জাতিসংঘসহ বিভিন্ন আন্তর্জাতিক সংস্থার সম্মাননা ও পুরস্কার, সামাজিক ব্যবসা ও উদ্ভাবনী অর্থনীতির ধারণা বিশ্বব্যাপী ছড়িয়ে দেওয়া। ড. ইউনুস বিশ্বাস করেন— “দারিদ্র্য মানুষের সৃষ্টি নয়, বরং একটি কৃত্রিম অবস্থা। সুযোগ ও সহায়তা পেলে প্রতিটি মানুষ তার ভাগ্য নিজেই গড়তে সক্ষম।”">
                    Details
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="infoModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-2xl w-full h-[500px] overflow-y-auto text-center relative">
            <button id="closeModal"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            <img id="modalImg" src="" alt="Person"
                class="w-32 h-32 mx-auto rounded-full border-4 border-indigo-500 mb-4 object-cover">
            <h3 id="modalName" class="text-xl font-bold text-indigo-700 mb-3"></h3>
            <p id="modalContent" class="text-gray-700 text-justify leading-relaxed whitespace-pre-line"></p>
        </div>
    </div>

    <script>
        const modal = document.getElementById("infoModal");
        const closeModal = document.getElementById("closeModal");
        const modalImg = document.getElementById("modalImg");
        const modalName = document.getElementById("modalName");
        const modalContent = document.getElementById("modalContent");

        document.querySelectorAll(".openModal").forEach(btn => {
            btn.addEventListener("click", () => {
                modalImg.src = btn.dataset.img;
                modalName.textContent = btn.dataset.name;
                modalContent.textContent = btn.dataset.content;
                modal.classList.remove("hidden");
            });
        });

        closeModal.addEventListener("click", () => modal.classList.add("hidden"));
        window.addEventListener("click", e => {
            if (e.target === modal) modal.classList.add("hidden");
        });
    </script>

    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-center">
            <span class="text-3xl text-indigo-700 font-bold">Institute Gallery</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
            <!-- Card 1 -->
            <div class="bg-blue-950 rounded-xl w-full p-6 text-center">
                <div class="flex flex-col justify-center items-center mb-4 gap-2">
                    <span class="text-xl font-semibold text-gray-100">প্রথম স্থান : ২০২০</span>
                    <span class="text-md text-gray-200">মোসাম্মৎ মিম আক্তার</span>
                    <img src="https://i.ibb.co/tS8kFvM/IMG-20250315-WA0110-1.jpg" alt=""
                        class="object-cover h-60 mt-2 border-4 border-indigo-600 rounded-lg">
                </div>
                <button
                    class="openGalleryModal py-2 px-4 w-full rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition duration-300"
                    data-title="প্রথম স্থান : ২০২০" data-name="মোসাম্মৎ মিম আক্তার"
                    data-desc="২০২০ সালে ইনস্টিটিউটের প্রথম স্থান অর্জন করে মিম আক্তার সবাইকে গর্বিত করেছেন।"
                    data-img="https://i.ibb.co/tS8kFvM/IMG-20250315-WA0110-1.jpg">
                    Details
                </button>
            </div>

            <!-- Card 2 -->
            <div class="bg-blue-950 rounded-xl w-full p-6 text-center">
                <div class="flex flex-col justify-center items-center mb-4 gap-2">
                    <span class="text-xl font-semibold text-gray-100">দ্বিতীয় স্থান -২০২২</span>
                    <span class="text-md text-gray-200">মো: রেজাউল করিম</span>
                    <img src="https://i.ibb.co/4RJJwTxD/IMG-20250821-WA0071.jpg" alt=""
                        class="object-cover h-60 mt-2 border-4 border-indigo-600 rounded-lg">
                </div>
                <button
                    class="openGalleryModal py-2 px-4 w-full rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition duration-300"
                    data-title="দ্বিতীয় স্থান -২০২২" data-name="মো: রেজাউল করিম"
                    data-desc="২০২২ সালে অসাধারণ ফলাফল করে দ্বিতীয় স্থান অর্জন করেন মো: রেজাউল করিম।"
                    data-img="https://i.ibb.co/4RJJwTxD/IMG-20250821-WA0071.jpg">
                    Details
                </button>
            </div>

            <!-- Card 3 -->
            <div class="bg-blue-950 rounded-xl w-full p-6 text-center">
                <div class="flex flex-col justify-center items-center mb-4 gap-2">
                    <span class="text-xl font-semibold text-gray-100">তৃতীয় স্থান -২০২০</span>
                    <span class="text-md text-gray-200">রবিউল শিকদার</span>
                    <img src="https://i.ibb.co/Cs4YKz9z/IMG-20250329-WA0071.jpg" alt=""
                        class="object-cover h-60 mt-2 border-4 border-indigo-600 rounded-lg">
                </div>
                <button
                    class="openGalleryModal py-2 px-4 w-full rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition duration-300"
                    data-title="তৃতীয় স্থান -২০২০" data-name="রবিউল শিকদার"
                    data-desc="রবিউল শিকদার ২০২০ সালে তৃতীয় স্থান অর্জন করেন, যা ইনস্টিটিউটের গর্বের বিষয়।"
                    data-img="https://i.ibb.co/Cs4YKz9z/IMG-20250329-WA0071.jpg">
                    Details
                </button>
            </div>

            <!-- Card 4 -->
            <div class="bg-blue-950 rounded-xl w-full p-6 text-center">
                <div class="flex flex-col justify-center items-center mb-4 gap-2">
                    <span class="text-xl font-semibold text-gray-100">প্রতিষ্ঠান চেয়ারম্যান</span>
                    <span class="text-md text-gray-200">মোঃ সামসুল আলম</span>
                    <img src="https://i.ibb.co/m5GSTHwY/IMG-20250914-WA0300-2.jpg" alt=""
                        class="object-cover h-60 mt-2 border-4 border-indigo-600 rounded-lg">
                </div>
                <button
                    class="openGalleryModal py-2 px-4 w-full rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition duration-300"
                    data-title="প্রতিষ্ঠান চেয়ারম্যান" data-name="মোঃ সামসুল আলম"
                    data-desc="মোঃ সামসুল আলম ইনস্টিটিউটের চেয়ারম্যান হিসেবে নেতৃত্ব দিচ্ছেন দীর্ঘদিন ধরে।"
                    data-img="https://i.ibb.co/m5GSTHwY/IMG-20250914-WA0300-2.jpg">
                    Details
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="galleryModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-md w-full text-center relative">
            <button id="closeGalleryModal"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
            <img id="galleryModalImg" src="" alt="Gallery Image"
                class="w-40 h-40 mx-auto rounded-xl border-4 border-indigo-500 mb-4 object-cover">
            <h3 id="galleryModalTitle" class="text-xl font-semibold text-indigo-700 mb-1"></h3>
            <p id="galleryModalName" class="text-gray-600 text-sm mb-3"></p>
            <p id="galleryModalDesc" class="text-gray-700 leading-relaxed"></p>
        </div>
    </div>

    <script>
        const galleryModal = document.getElementById("galleryModal");
        const closeGalleryModal = document.getElementById("closeGalleryModal");
        const galleryModalTitle = document.getElementById("galleryModalTitle");
        const galleryModalName = document.getElementById("galleryModalName");
        const galleryModalDesc = document.getElementById("galleryModalDesc");
        const galleryModalImg = document.getElementById("galleryModalImg");

        document.querySelectorAll(".openGalleryModal").forEach(btn => {
            btn.addEventListener("click", () => {
                galleryModalTitle.textContent = btn.dataset.title;
                galleryModalName.textContent = btn.dataset.name;
                galleryModalDesc.textContent = btn.dataset.desc;
                galleryModalImg.src = btn.dataset.img;
                galleryModal.classList.remove("hidden");
            });
        });

        closeGalleryModal.addEventListener("click", () => {
            galleryModal.classList.add("hidden");
        });

        window.addEventListener("click", (e) => {
            if (e.target === galleryModal) galleryModal.classList.add("hidden");
        });
    </script>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-center">
            <h2 class="text-3xl font-bold text-indigo-700">Student Testimonials</h2>
        </div>

        <div class="w-full mt-8 flex flex-col space-y-6">
            <!-- Single Testimonial -->
            <div
                class="p-6 rounded-xl shadow-2xl bg-blue-950 backdrop-blur-sm border-4 border-gray-200 transition-all duration-500 hover:shadow-xl">
                <div class="flex items-start space-x-4">
                    <img src="https://i.ibb.co/QtdWcpt/IMG-20250827-WA0087.jpg" alt="মোহাম্মদ সোহেল রানা"
                        class="w-16 h-16 object-cover rounded-full border-2 border-indigo-500">

                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">মোহাম্মদ সোহেল রানা</h3>
                        <p class="text-indigo-200 text-sm mb-2">শিক্ষার্থী - ২০২০</p>
                        <blockquote class="text-indigo-100 italic border-l-2 border-indigo-400 pl-4">
                            " Electrical Installation & Maintenance "আমি Electrical কোর্স সম্পন্ন করার পর দ্রুত চাকরির সুযোগ
                            পেয়েছি। এখানকার প্রশিক্ষকরা আন্তরিকভাবে সবকিছু শিখিয়েছেন। এখন আমি একটি নামকরা প্রতিষ্ঠানে
                            টেকনিশিয়ান হিসেবে কাজ করছি।" English: "After completing the Electrical course, I quickly secured
                            a job. The instructors taught everything with great sincerity. Today, I am working as a
                            technician in a reputed organization.""
                        </blockquote>
                    </div>
                </div>

                <div class="mt-4">
                    <button
                        class="openModal px-4 py-2 rounded-full bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition duration-300"
                        data-name="মোহাম্মদ সোহেল রানা" data-year="শিক্ষার্থী - ২০২০"
                        data-story="Electrical Installation & Maintenance আমি Electrical কোর্স সম্পন্ন করার পর দ্রুত চাকরির সুযোগ পেয়েছি। এখানকার প্রশিক্ষকরা আন্তরিকভাবে সবকিছু শিখিয়েছেন। এখন আমি একটি নামকরা প্রতিষ্ঠানে টেকনিশিয়ান হিসেবে কাজ করছি। English: After completing the Electrical course, I quickly secured a job. The instructors taught everything with great sincerity. Today, I am working as a technician in a reputed organization."
                        data-img="https://i.ibb.co/QtdWcpt/IMG-20250827-WA0087.jpg">
                        Read Full Story
                    </button>
                </div>
            </div>

            <div
                class="p-6 rounded-xl shadow-2xl bg-blue-950 backdrop-blur-sm border-4 border-gray-200 transition-all duration-500 hover:shadow-xl">
                <div class="flex items-start space-x-4">
                    <img src="https://i.ibb.co/v9z8kmC/t4.jpg" alt="মোসাম্মদ আফসানা আক্তার"
                        class="w-16 h-16 object-cover rounded-full border-2 border-indigo-500">

                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">মোসাম্মদ আফসানা আক্তার</h3>
                        <p class="text-indigo-200 text-sm mb-2">শিক্ষার্থী - ২০২০</p>
                        <blockquote class="text-indigo-100 italic border-l-2 border-indigo-400 pl-4">
                            প্রশিক্ষণ শেষে আমার আত্মবিশ্বাস অনেক বেড়েছে। এখানে শেখানো দক্ষতা আমাকে কর্মজগতে এগিয়ে নিতে
                            সাহায্য করেছে।" ইংরেজি: "My confidence increased tremendously after the training. The skills I
                            learned here helped me advance in my career
                        </blockquote>
                    </div>
                </div>

                <div class="mt-4">
                    <button
                        class="openModal px-4 py-2 rounded-full bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition duration-300"
                        data-name="মোসাম্মদ আফসানা আক্তার" data-year="শিক্ষার্থী - ২০২০"
                        data-story="প্রশিক্ষণ শেষে আমার আত্মবিশ্বাস অনেক বেড়েছে। এখানে শেখানো দক্ষতা আমাকে কর্মজগতে এগিয়ে নিতে সাহায্য করেছে। ইংরেজি: My confidence increased tremendously after the training. The skills I learned here helped me advance in my career"
                        data-img="https://i.ibb.co/v9z8kmC/t4.jpg">
                        Read Full Story
                    </button>
                </div>
            </div>

            <!-- Another Testimonial -->
            <div
                class="p-6 rounded-xl shadow-2xl bg-blue-950 backdrop-blur-sm border-4 border-gray-200 transition-all duration-500 hover:shadow-xl">
                <div class="flex items-start space-x-4">
                    <img src="https://i.ibb.co/JR2KTby5/IMG-20250813-WA0220.jpg" alt="মোহাম্মদ রফিক"
                        class="w-16 h-16 object-cover rounded-full border-2 border-indigo-500">

                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">মোহাম্মদ রফিক</h3>
                        <p class="text-indigo-200 text-sm mb-2">শিক্ষার্থী - ২০২০</p>
                        <blockquote class="text-indigo-100 italic border-l-2 border-indigo-400 pl-4">
                            "এই ইনস্টিটিউটে প্রশিক্ষণ নিয়ে আমার পেশাগত দক্ষতা অনেক বৃদ্ধি পেয়েছে। শিক্ষকরা খুবই সহায়ক এবং
                            বাস্তব অভিজ্ঞতার উপর ভিত্তি করে শেখান।" ইংরেজি: "My professional skills improved significantly
                            after training at this institute. The instructors are very supportive and focus on practical,
                            real-world experience.""
                            "বাংলা: আমাদের ট্রেনিং শেষ করার পর একটি আন্তর্জাতিক সফটওয়্যার কোম্পানিতে সিনিয়র ডেভেলপার পদে
                            যোগদান করেছেন। English: After completing her training, she joined an international software
                            company as a Senior Developer."
                            Read Full Story
                        </blockquote>
                    </div>
                </div>

                <div class="mt-4">
                    <button
                        class="openModal px-4 py-2 rounded-full bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition duration-300"
                        data-name="মোহাম্মদ রফিক" data-year="শিক্ষার্থী - ২০২০"
                        data-story="এই ইনস্টিটিউটে প্রশিক্ষণ নিয়ে আমার পেশাগত দক্ষতা অনেক বৃদ্ধি পেয়েছে। শিক্ষকরা খুবই সহায়ক এবং বাস্তব অভিজ্ঞতার উপর ভিত্তি করে শেখান। ইংরেজি: My professional skills improved significantly after training at this institute. The instructors are very supportive and focus on practical, real-world experienceবাংলা: আমাদের ট্রেনিং শেষ করার পর একটি আন্তর্জাতিক সফটওয়্যার কোম্পানিতে সিনিয়র ডেভেলপার পদে যোগদান করেছেন। English: After completing her training, she joined an international software company as a Senior Developer.Read Full Story"
                        data-img="https://i.ibb.co/JR2KTby5/IMG-20250813-WA0220.jpg">
                        Read Full Story
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="storyModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-md w-full text-center relative">
            <button id="closeModal"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
            <img id="modalImg" src="" alt="Student"
                class="w-24 h-24 mx-auto rounded-full border-4 border-indigo-500 mb-4">
            <h3 id="modalName" class="text-xl font-semibold text-indigo-700"></h3>
            <p id="modalYear" class="text-gray-500 text-sm mb-4"></p>
            <p id="modalStory" class="text-gray-700 leading-relaxed"></p>
        </div>
    </div>

    <script>
        const modal = document.getElementById("storyModal");
        const closeModal = document.getElementById("closeModal");
        const modalName = document.getElementById("modalName");
        const modalYear = document.getElementById("modalYear");
        const modalStory = document.getElementById("modalStory");
        const modalImg = document.getElementById("modalImg");

        document.querySelectorAll(".openModal").forEach(btn => {
            btn.addEventListener("click", () => {
                modalName.textContent = btn.dataset.name;
                modalYear.textContent = btn.dataset.year;
                modalStory.textContent = btn.dataset.story;
                modalImg.src = btn.dataset.img;
                modal.classList.remove("hidden");
            });
        });

        closeModal.addEventListener("click", () => {
            modal.classList.add("hidden");
        });

        window.addEventListener("click", (e) => {
            if (e.target === modal) modal.classList.add("hidden");
        });
    </script>

    <div class="container mx-auto px-4 pb-4">
        <div class="bg-blue-950 text-white rounded-lg p-6 text-center">
            <div class="flex justify-center p-4 sm:p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row text-gray-100">

                    <div
                        class="lg:w-1/2 flex-shrink-0 relative h-64 sm:h-80 md:h-96 lg:h-[500px] flex items-center justify-center p-4 rounded-lg overflow-hidden border border-indigo-600 shadow-lg mb-6 lg:mb-0">
                        <iframe class="w-full h-full rounded-lg" src="https://www.youtube.com/embed/9XcGxqtI7GM"
                            title="বাংলাদেশের জাতীয় সংগীত | Bangladesh National Anthem." frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>

                    <div class="lg:w-2/3 lg:px-10 flex-grow flex flex-col items-start overflow-y-auto">
                        <h2
                            class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-indigo-400 mb-6 pb-3 border-b border-indigo-600 text-left">
                            ট্রেনিং সেন্টারের শিক্ষার্থীদের জানা নিয়মাবলী ও নির্দেশনা
                        </h2>

                        <p class="text-indigo-200 text-base sm:text-lg mb-6 leading-relaxed text-left">
                            <span class="text-yellow-400 text-2xl mr-2">⚡</span>
                            আমাদের প্রত্যাশা তোমাদের প্রতিশ্রুতি
                        </p>

                        <ul class="list-none space-y-5 text-gray-200 text-base md:text-lg text-left">
                            <li>
                                <strong class="text-yellow-300">উপস্থিতি ও সময়ানুবর্তিতা:</strong>
                                প্রতিদিন সময়মতো ক্লাসে যোগদান করা...
                            </li>
                            <li>
                                <strong class="text-yellow-300">শ্রদ্ধাশীল আচরণ:</strong>
                                শিক্ষক ও সহপাঠীদের সাথে সম্মানজনক ব্যবহার।
                            </li>
                            <li>
                                <strong class="text-yellow-300">ক্লাসের প্রস্তুতি:</strong>
                                প্রয়োজনীয় বই ও খাতা সাথে আনা।
                            </li>
                            <li>
                                <strong class="text-yellow-300">মনোযোগ:</strong>
                                ক্লাস চলাকালে মোবাইল ব্যবহার না করা।
                            </li>
                            <li>
                                <strong class="text-yellow-300">অ্যাসাইনমেন্ট জমা:</strong>
                                নির্দিষ্ট সময়সীমার মধ্যে অ্যাসাইনমেন্ট জমা দেওয়া।
                            </li>
                            <li>
                                <strong class="text-yellow-300">নিষিদ্ধ কার্যকলাপ:</strong>
                                ধূমপান, মাদকদ্রব্য সেবন এবং রাজনৈতিক কর্মকাণ্ড থেকে বিরত থাকা...
                            </li>
                            <li>
                                <strong class="text-yellow-300">নিরাপত্তা ও শৃঙ্খলা: </strong>
                                নিরাপত্তা বিষয়ক সকল নির্দেশনা মেনে চলা...
                            </li>
                            <li>
                                <strong class="text-yellow-300">পরীক্ষা ও মূল্যায়ন: </strong>
                                নির্ধারিত সময়ে সকল পরীক্ষা ও অ্যাসাইনমেন্ট জমা দেওয়া...
                            </li>
                            <li>
                                <strong class="text-yellow-300">উপস্থিতি ও সার্টিফিকেট: </strong>
                                সফলভাবে কোর্স সম্পন্ন করার জন্য ন্যূনতম উপস্থিতি বাধ্যতামূলক...
                            </li>
                            <li>
                                <strong class="text-yellow-300">নৈতিকতা ও চরিত্র গঠন: </strong>
                                সততা, শৃঙ্খলা ও দায়িত্বশীলতার সাথে নিজেকে গড়ে তোলা...
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div
            class="grid grid-cols-1 lg:grid-cols-2 items-center lg:gap-16 bg-blue-950 md:p-8 rounded-xl border-4 p-4 transition-all duration-500 hover:shadow-2xl">

            <div class="order-1 flex justify-center items-center p-4">
                <img alt="Kazi Nazrul Islam"
                    class="w-full max-w-xs md:max-w-sm rounded-2xl shadow-2xl shadow-indigo-500/20 transition transform duration-300 hover:scale-105"
                    src="https://i.ibb.co.com/fgpZWJX/images-1.jpg">
            </div>

            <div class="order-2 mt-8 lg:mt-0 lg:p-4 rounded-xl p-4 transition-all duration-300 hover:shadow-2xl">
                <h1 class="text-2xl md:text-3xl font-bold mb-4 text-indigo-400">
                    "The National Revolutionary Song of Bangladesh by"
                    <span class="text-white">Kazi Nazrul Islam</span>
                </h1>

                <p class="max-w-prose text-sm leading-relaxed text-white mb-6">
                    <strong class="text-base">March on, march on!</strong><br>
                    Above, the drums resound in the sky, Below, the earth trembles with fiery steps.
                    The youthful bands of dawn rise- March on, o march, march, march!
                    At the threshold of the morning, shall strike with courage, we shall bring a glorious red dawn,
                    Breaking the dark night that binds the world, Forward we march, never turning back.
                    With songs of the new and the youthful, We shall breathe life into the silent grounds of
                    despair,
                    we shall give strength to the arms of the young, And awaken a force that has never yet been
                    seen.
                    Forward, o youth! Open your ears and listen- At the gateways where death and fear linger,
                    Life itself calls to you. Break the chains, shatter the barriers,
                    And march, march onward without hesitation.
                    Let the crimson morning rise from every shadow, Let the light of hope pierce the deepest gloom,
                    Let the songs of the new, of courage, of freedom,
                    Resound in every heart, in every hand, in every step.
                </p>

                <p class="max-w-prose text-sm leading-relaxed text-white">
                    <strong class="text-base">বাংলাদেশের জাতীয় রণ সংগীত:</strong>
                    কাজী নজরুল ইসলাম
                    চল্ চল্ চল্। ঊর্ধ্ব গগনে বাজে মাদল, নিম্নে উত্তলা ধরণী-তল।
                    অরুণ প্রাতের তরুণ দল, চল রে চল রে চল্। চল্ চল্ চল্।
                    ঊষার দুয়ারে হানি আঘাত, আমরা আনিব রাঙা প্রভাত। আমরা টুটাব তিমির রাত,
                    বাঁধার বিন্ধ্যা চল। নব নবীনের গাহিয়া গান, সঞ্জীব করিব মহাশ্মশান।
                    আমরা দানিব নতুন প্রাণ, বাহুতে নবীন বল।
                    চল রে নওজোয়ান, শোন রে পাতিয়া কান। মৃত্যু-তোরণ-দুয়ারে দুয়ারে,
                    জীবনের আহ্বান। ভাঙ রে ভাঙ আগল, চল রে চল রে চল্ চল্ চল্ চল্‌।
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <span class="block text-center text-gray-600 text-sm">এখানে আমাদের শিক্ষার্থীদের মতামতগুলো দেখুন যারা আমাদের
            কোর্স সম্পন্ন করেছেন এবং সফল হয়েছেন।</span>
    </div>


    <div class="overflow-hidden">
        <div id="card-slider" class="flex gap-4 my-6 px-4">
            @foreach ($student as $data)
                <div class="bg-[#3a7a7a] rounded-lg p-6 flex-shrink-0 w-80 flex flex-col space-y-4">
                    <div class="text-yellow-400 text-sm flex space-x-1">
                        <i class="ri-star-fill text-yellow-400"></i>
                        <i class="ri-star-fill text-yellow-400"></i>
                        <i class="ri-star-fill text-yellow-400"></i>
                        <i class="ri-star-fill text-yellow-400"></i>
                        <i class="ri-star-line text-yellow-400"></i>
                    </div>
                    <p class="text-xs text-white">
                        {{ $data->institute_name }}
                    </p>
                    <div class="flex items-center space-x-3 mt-auto">
                        <img alt="Portrait" class="rounded-full w-10 h-10" src="{{ asset($data->profile_photo) }}">
                        <div>
                            <p class="text-white text-sm font-semibold">{{ $data->name }}</p>
                            <p class="text-gray-300 text-xs">Student</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <section
        class="bg-gradient-to-br from-gray-950 via-gray-900 to-indigo-950 py-12 md:py-14 px-4 md:px-8 mx-4 md:mx-8 xl:mx-40 rounded-2xl my-8 md:my-10">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-gray-100 font-semibold text-2xl md:text-3xl">
                "Our Impact in"
                <span class="font-bold text-indigo-400">Numbers</span>
            </h2>
            <p class="text-gray-400 text-sm md:text-base mt-2 max-w-xl mx-auto">
                Real stories, real success. Discover how far our students have come
            </p>

            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div
                    class="bg-gray-800 bg-opacity-80 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center shadow-lg hover:shadow-indigo-500/50 transition duration-300 border border-gray-700 h-full">
                    <div class="text-indigo-400 text-4xl mb-3" aria-label="Icon for Course Completed">
                        <i class="ri-checkbox-circle-fill"></i>
                    </div>
                    <p class="text-indigo-400 font-extrabold text-3xl"><span>830,000+</span></p>
                    <p class="text-gray-400 text-sm mt-2">Course Completed</p>
                </div>

                <div
                    class="bg-gray-800 bg-opacity-80 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center shadow-lg hover:shadow-indigo-500/50 transition duration-300 border border-gray-700 h-full">
                    <div class="text-indigo-500 text-4xl mb-3" aria-label="Icon for Job Placements">
                        <i class="ri-briefcase-4-fill"></i>
                    </div>
                    <p class="text-indigo-500 font-extrabold text-3xl"><span>229,406+</span></p>
                    <p class="text-gray-400 text-sm mt-2">Job Placements</p>
                </div>

                <div
                    class="bg-gray-800 bg-opacity-80 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center shadow-lg hover:shadow-indigo-500/50 transition duration-300 border border-gray-700 h-full">
                    <div class="text-pink-400 text-4xl mb-3" aria-label="Icon for Successful Freelancers">
                        <i class="ri-user-3-fill"></i>
                    </div>
                    <p class="text-pink-400 font-extrabold text-3xl"><span>224,448+</span></p>
                    <p class="text-gray-400 text-sm mt-2">Successful Freelancers</p>
                </div>

                <div
                    class="bg-gray-800 bg-opacity-80 backdrop-blur-sm rounded-xl p-6 flex flex-col items-center shadow-lg hover:shadow-indigo-500/50 transition duration-300 border border-gray-700 h-full">
                    <div class="text-pink-500 text-4xl mb-3" aria-label="Icon for New Entrepreneurs">
                        <i class="ri-lightbulb-flash-line"></i>
                    </div>
                    <p class="text-pink-400 font-extrabold text-3xl"><span>50,000+</span></p>
                    <p class="text-gray-400 text-sm mt-2">New Entrepreneurs</p>
                </div>
            </div>
        </div>
    </section>
@endsection
