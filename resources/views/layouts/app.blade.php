<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="{{ asset('images/logo4.png') }}" rel="icon" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/motion@11.11.17/dist/motion.min.js"></script>
    <!-- Fonts -->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .sign_container {
            /* Flexbox yoqiladi */
            display: flex;

            /* Gorizontal (o'ng-chap) markazga oladi */
            justify-content: center;

            /* Vertikal (tepa-past) markazga oladi */
            align-items: center;

            /* Muhim: Vertikal markazlash uchun ota elementning balandligi belgilangan bo'lishi kerak */
            height: 100vh;
            /* Misol uchun, ekranning to'liq balandligi */
            width: 100%;
            padding: 20px;
        }

        /** katta ekranlarga */
        @media screen and (min-width: 769px) {
            .cards_home {
                display: grid;
                grid-template-columns: repeat(10, 1fr);
                grid-column-gap: 10px;
                grid-row-gap: 10px;
                overflow-y: auto !important;
            }

            .app_btn_section {
                position: fixed;
                top: 60px;
                left: 20px;
                z-index: 10;
            }

            #dropdown_add_note {
                position: auto;
                margin-top: 20px;
                width: 250px;
                background-color: white;
                border-radius: 10px;
                padding: 10px;
                box-shadow: 0px 0px 5px 0px black;
                z-index: 10;
            }

            #menu_dropdown {
                position: auto;
                margin-top: 20px;
                width: 250px;
                background-color: white;
                border-radius: 10px;
                padding: 10px;
                box-shadow: 0px 0px 5px 0px black;
                z-index: 10;
            }

            .cards_home {
                padding: 10px;
            }

            .container_1 {
                position: relative;
                width: 202vh;
                top: 2vh;
                height: 95vh;
                overflow: auto;
            }

        }

        /*telefon*/
        @media screen and (max-width: 769px) {
            .cards_home {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 20px;
                padding: 10px;
            }

            .container_1 {
                display: flex;
                position: relative;
                width: 48vh auto;
                align-items: center;
                justify-items: center;
                top: 10vh;
            }
        }

        /*planshetlar uchun*/
        @media (min-width: 769px) and (max-width: 1024px) {
            .cards_home {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                grid-gap: 20px;
                padding: 30px;
            }

            .container_1 {
                display: flex;
                position: relative;
                width: 70vh;
                align-items: center;
                justify-items: center;
                top: 5vh;
            }
        }

        /* preloader css kodlari*/
        #preloader {
            position: absolute;
            z-index: 11;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: "Inter", sans-serif;
            color: white;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .notezy-logo {
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: 2px;
            position: relative;
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
            animation: glow 2s ease-in-out infinite alternate;
        }

        /* Yonib turgan logo */
        @keyframes glow {
            from {
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
                opacity: 0.9;
            }

            to {
                text-shadow: 0 0 25px rgba(255, 255, 255, 0.8);
                opacity: 1;
            }
        }

        /* --- QOG‘OZ STACK (SODDALASHTIRILGAN) --- */
        .paper-stack {
            position: relative;
            width: 80px;
            height: 60px;
            margin-top: 30px;
        }

        .paper {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #fff;
            border-radius: 8px;
            opacity: 0.9;
            animation: floatPaper 2.5s ease-in-out infinite;
        }

        .paper:nth-child(2) {
            top: 5px;
            left: 5px;
            opacity: 0.7;
            animation-delay: 0.3s;
        }

        .paper:nth-child(3) {
            top: 10px;
            left: 10px;
            opacity: 0.5;
            animation-delay: 0.6s;
        }

        @keyframes floatPaper {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* --- TO‘LQIN CHIZIQLAR (YENGIL) --- */
        .wave {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            gap: 6px;
        }

        .bar {
            width: 6px;
            height: 25px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 3px;
            animation: waveAnim 1.2s ease-in-out infinite;
        }

        .bar:nth-child(2) {
            animation-delay: 0.2s;
        }

        .bar:nth-child(3) {
            animation-delay: 0.4s;
        }

        .bar:nth-child(4) {
            animation-delay: 0.6s;
        }

        .bar:nth-child(5) {
            animation-delay: 0.8s;
        }

        @keyframes waveAnim {

            0%,
            100% {
                transform: scaleY(0.6);
                opacity: 0.5;
            }

            50% {
                transform: scaleY(1.2);
                opacity: 1;
            }
        }

        /* --- YUKLANMOQDA MATNI --- */
        .message {
            margin-top: 25px;
            font-size: 1rem;
            opacity: 0.85;
            animation: fadeInOut 3s ease-in-out infinite;
        }

        @keyframes fadeInOut {

            0%,
            100% {
                opacity: 0;
                transform: translateY(5px);
            }

            50% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- FADE OUT EFFEKTI --- */
        .fade-out {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.6s ease-out, visibility 0.6s ease-out;
        }

        /* preloader css kodlari tugadi*/
        .card {
            z-index: 1;
        }

        #dropdown_add_note textarea {
            max-height: 200px;
        }

        .show_note_more {
            position: absolute;
            z-index: 10;
            width: 70%;
            top: 30%;
        }

        .card_text {
            height: 200px;
            overflow-y: scroll;
        }

        .cursor {
            display: inline-block;
            background-color: black;
            width: 2px;
            height: 1.2em;
            /* Adjust to match font size */
            animation: blink-cursor 0.75s step-end infinite;
        }

        @keyframes blink-cursor {

            from,
            to {
                background-color: transparent;
            }

            50% {
                background-color: black;
            }
        }

        .navbar {
            position: fixed;
            z-index: 10;
        }
    </style>
</head>

<body>
    <div id="preloader" class="fixed inset-0 flex flex-col items-center justify-center bg-base-100 z-50">
        <img src="{{ asset('images/notezy_preloader.webp') }}" alt="Yuklanmoqda..."
            class="w-24 h-24 mb-4 animate-pulse">
        <p class="text-lg font-semibold text-base-content">Yuklanmoqda...</p>
    </div>
    <nav class="navbar bg-base-100 shadow-md px-6 py-3 flex justify-between items-center">
        {{-- Logo --}}
        <div class="flex items-center gap-3">
            @guest
                @if (Route::has('login'))
                @endif
                @if (Route::has('register'))
                @endif
            @else
                <button id="sidebarToggle" class="btn btn-ghost btn-circle">
                    <i class="fa-solid fa-bars"></i>
                </button>
            @endguest
            <a href="{{ url('/') }}" class="text-2xl font-bold text-primary">Notezy</a>
        </div>
        {{-- O'ng taraf --}}
        <div class="flex items-center gap-3">
            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-right-to-bracket mr-1"></i>Kirish
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-sm btn-outline">
                        <i class="fa-solid fa-user-plus mr-1"></i>Ro‘yxatdan o‘tish
                    </a>
                @endif
            @else
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-sm flex items-center gap-2">
                        <i class="fa-solid fa-user"></i>
                        {{ Auth::user()->name }}
                        <i class="fa-solid fa-caret-down text-xs"></i>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box shadow-md w-40"
                        style="top: 2vh;">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-20">
                                    <i class="fa-solid fa-right-from-bracket"></i> Chiqish
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>

    </nav>
    @guest
        @if (Route::has('login'))
        @endif
        @if (Route::has('register'))
        @endif
    @else
        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed top-0 left-0 h-full w-64 bg-base-100 border-r border-base-300 shadow-lg transform -translate-x-full transition-transform duration-300 z-50">

            <div class="flex items-center justify-between px-4 py-4 border-b border-base-300">
                <span class="text-xl font-semibold">Menyu</span>
                <button id="closeSidebar" class="text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <nav class="p-4 space-y-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-base-200 transition">
                    <i class="fa-solid fa-house"></i> <span>Bosh sahifa</span>
                </a>
                <a href="{{ route('note_archives') }}"
                    class="flex items-center gap-3 p-2 rounded-lg hover:bg-base-200 transition">
                    <i class="fa-solid fa-inbox"></i> <span>Arxiv</span>
                </a>
                <hr class="border-base-300">

                <hr class="border-gray-300 dark:border-gray-700">

                <div class="flex items-center gap-2 p-2">
                    <i class="fa-solid fa-palette text-primary"></i>
                    <select id="themeSelect" class="select select-bordered w-full">
                        <option disabled selected>Mavzuni tanlang</option>
                        <option value="light">Yorqin</option>
                        <option value="dark">Tungi</option>
                        <option value="cupcake">Shirin</option>
                        <option value="emerald">Zumrad</option>
                        <option value="corporate">Korporativ</option>
                        <option value="dracula">Drakula</option>
                        <option value="retro">Retro</option>
                    </select>
                </div>
            </nav>
        </aside>
    @endguest
    {{-- Overlay (sidebar orqasi qorayadi) --}}
    <div id="overlay" class="hidden fixed inset-0 bg-black/40 z-40"></div>
    <script>
        // Sidebar ochib yopish
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });
        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // DaisyUI Theme boshqaruvi
        const themeSelect = document.getElementById('themeSelect');
        const userTheme = localStorage.getItem('theme');

        if (userTheme) {
            document.documentElement.setAttribute('data-theme', userTheme);
            themeSelect.value = userTheme;
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const systemTheme = prefersDark ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', systemTheme);
            themeSelect.value = systemTheme;
        }

        themeSelect.addEventListener('change', (e) => {
            const theme = e.target.value;
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        });
    </script>

    @yield('app_btn_section')
    @guest
        @if (Route::has('login') || Route::has('register'))
            <main class="sign_container">
                @yield('sign_page')
            </main>
        @endif
    @else
        <main class="py-4 container_1">
            @yield('content')
        </main>
    @endguest
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
    integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    $("#new_note_type_value").val($("#old_note_type_value").val()).change();
    // preloader kodlari
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        preloader.classList.add('opacity-0', 'transition', 'duration-500');
        setTimeout(() => preloader.remove(), 500);
    });

    $("#menu_dropdown").hide();
    // eslatma qoshish formasi
    $("#dropdown_add_note").hide();
    $("#dropdown_add_note_button").click(function() {
        $("#menu_dropdown").hide(700);
        $("#dropdown_add_note").toggle(800);
        motion.animate($("#dropdown_add_note"), {
            opacity: [0, 1],
            y: [-20, 0]
        }, {
            duration: 0.4
        });
    });
    // eslatma qoshish formasi tugadi
    // menu section
    function toggle_menu_dropdown() {
        $("#dropdown_add_note").hide(700);
        $("#menu_dropdown").toggle(800);
    }
    // eslatmani bazaga saqlash
    $("#save_note_btn").click(function() {
        Toastify({
            text: "Yuborilmoqda",
            className: "warning",
            style: {
                background: "linear-gradient(120deg, #f6d365 0%, #fda085 100%)",
            }
        }).showToast();
        let data = {
            note_title: $("#note_title").val(),
            note_text: $("#note_text").val(),
            note_type: $("#note_category").val()
        };
        $.ajax({
            url: "{{ route('save_note') }}",
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token
                'ngrok-skip-browser-warning': '1' // ngrok warningni skip qilish
            },
            success: function(response) {
                Toastify({
                    text: "Eslatma saqlandi",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
                location.reload(1000);
            },
            error: function() {
                Toastify({
                    text: "Eslatmani saqlab bo'lmadi",
                    className: "danger",
                    style: {
                        background: "linear-gradient(120deg, #f093fb 0%, #f5576c 100%)",
                    }
                }).showToast();
            }
        });
    })
    // eslatmani bazaga saqlash tugadi
    // eslatmani toliq korish sahifasida inputlarni disable dan chqarish
    $("#new_note_type_value").val($("#old_note_type_value").val())
        .change(); //eslatmani toliq korish sahifasida selectga bazadegi qiymatni berish
    $("#note_value_change").click(function() {
        $("#note_more_edit_button").append(`
            <button class="btn btn-primary col-lg-2 m-2" type="submit"
                            id="note_value_save">Saqlash</button>
        `);
        $("#note_value_save").hide();
        $("#note_value_change").hide(300);
        $("#note_value_save").show(600);
        document.getElementById('new_note_title_value').disabled = false;
        document.getElementById('new_note_text_value').disabled = false;
        document.getElementById('new_note_type_value').disabled = false;
        $('#modal-title-input').prop('disabled', false);
        $('#modal-text-input').prop('disabled', false);
        $('#modal-type-input').prop('disabled', false);
    });

    // function check_note_old_value() {
    //     let new_note_title_value = $("#new_note_title_value").val();
    //     let new_note_text_value = $("#new_note_text_value").val();
    //     let new_note_type_value = $("#new_note_type_value").val();
    //     let old_note_title_value = $("#old_note_title_value").val();
    //     let old_note_text_value = $("#old_note_text_value").val();
    //     let old_note_type_value = $("#old_note_type_value").val();
    //     new_form_values = new_note_title_value + new_note_text_value + new_note_type_value;
    //     old_form_values = old_note_title_value + old_note_text_value + old_note_type_value;
    //     if (new_form_values == old_form_values) {
    //         document.getElementById('note_update_btn').disabled = true;
    //     } else {
    //         document.getElementById('note_update_btn').disabled = false;
    //     }
    // }

    //eslatmalarni sortlash
    function sort_notes() {

        note_sort_value = $("#note_sort_value").val();
        console.log(note_sort_value);

        if (note_sort_value == "all") {
            $(".note_card").hide(200);
            $(".note_card").show(400);
        } else {
            $(".note_card").hide(200);
            $(".note_type_" + note_sort_value).show(400);
        }
    }

    // Note card ustiga bosilganda Ajax
    function getNoteMore(noteId) {
        $.ajax({
            url: '/get-note-more' + noteId, // Laravel route
            type: 'GET',
            success: function(data) {
                // Ma’lumotlarni modalga yuklash
                $('#modal-note-id').val(data.id);
                $('#modal-title').text(data.note_title);
                $('#modal-title-input').val(data.note_title);
                $('#modal-text-input').val(data.note_text);
                $('#modal-type-input').val(data.note_type);
                $('#archive-link').attr('href', '/archive-note/' + data.id);

                // Modalni ochish
                showNoteModal();

            },
            error: function(err) {
                alert('Ma’lumot yuklanmadi');
            }
        });
    }

    // // Edit tugmasi
    // $('#enable-edit').on('click', function() {
    //     $('#modal-title-input').prop('disabled', false);
    //     $('#modal-text-input').prop('disabled', false);
    //     $('#modal-type-input').prop('disabled', false);
    // });
    function push_notif() {
        if (Notification.permission === "granted") {
            new Notification("Laravel bildirishnoma", {
                body: "Bu localhost:8000 da ham ishlaydi ✅"
            });
        } else if (Notification.permission !== "denied") {
            Notification.requestPermission().then(permission => {
                if (permission === "granted") {
                    new Notification("Laravel bildirishnoma", {
                        body: "Ruxsat berilgandan keyin ham ishlayapti 🚀"
                    });
                }
            });
        }
    }
</script>


</html>
