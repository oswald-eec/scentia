<x-app-layout>
    
    {{-- Seccion Portada --}}
    <section >
        <div >
            @php
                $slides = $promotions->map(fn($p) => [
                    'imgSrc' => asset('storage/' . $p->image_url),
                    'imgAlt' => $p->name,
                    'title' => $p->name,
                    'description' => $p->description,
                ]);
            @endphp
            <div x-data='{
                autoplayIntervalTime: 4000,
                slides: @json($slides),
                currentSlideIndex: 1,
                isPaused: false,
                autoplayInterval: null,
                previous() {                
                    if (this.currentSlideIndex > 1) {                    
                        this.currentSlideIndex = this.currentSlideIndex - 1;                
                    } else {                    
                        this.currentSlideIndex = this.slides.length;                
                    }            
                },            
                next() {                
                    if (this.currentSlideIndex < this.slides.length) {                    
                        this.currentSlideIndex = this.currentSlideIndex + 1;                
                    } else {                    
                        this.currentSlideIndex = 1;                
                    }            
                },    
                autoplay() {
                    this.autoplayInterval = setInterval(() => {
                        if (!this.isPaused) {
                            this.next();
                        }
                    }, this.autoplayIntervalTime);
                },
                setAutoplayInterval(newIntervalTime) {
                    clearInterval(this.autoplayInterval);
                    this.autoplayIntervalTime = newIntervalTime;
                    this.autoplay();
                }
            }' x-init="autoplay" class="relative w-full overflow-hidden">
       
                <!-- Slides -->
                <div class="relative min-h-[500px] w-full">
                    <template x-for="(slide, index) in slides">
                        <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                            
                            <!-- Título y descripción -->
                            <div class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-gradient-to-t from-neutral-950/85 to-transparent px-16 py-12 text-center">
                                <h3 class="w-full lg:w-[80%] text-2xl lg:text-3xl font-bold text-white" x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                                <p class="lg:w-1/2 w-full text-sm text-neutral-300" x-text="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                            </div>
    
                            <!-- Imagen -->
                            <img class="absolute w-full h-full inset-0 object-cover" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                        </div>
                    </template>
                </div>
    
                <!-- Botón Pausar/Reproducir -->
                <button type="button" class="absolute bottom-5 right-5 z-20 rounded-full text-neutral-300 opacity-50 transition hover:opacity-80 focus-visible:opacity-80" x-on:click="(isPaused = !isPaused), setAutoplayInterval(autoplayIntervalTime)" x-bind:aria-pressed="isPaused">
                    <svg x-cloak x-show="isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-7 h-7">
                        <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z" clip-rule="evenodd"/>
                    </svg>
                    <svg x-cloak x-show="!isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-7 h-7">
                        <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm5-2.25A.75.75 0 0 1 7.75 7h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Zm4 0a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Z" clip-rule="evenodd"/>
                    </svg>
                </button>
    
                <!-- Indicadores de progreso -->
                <div class="absolute rounded-md bottom-3 left-1/2 z-20 flex -translate-x-1/2 gap-3 px-2" role="group" aria-label="slides">
                    <template x-for="(slide, index) in slides">
                        <button class="w-2 h-2 rounded-full transition" x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-neutral-300' : 'bg-neutral-300/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Seccion Contenido --}}
    <section class="mt-20">
        <h1 class="text-gray-800 text-center text-4xl font-bold mb-8">Contenido</h1>
    
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
            <!-- Cursos Section -->
            <article class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <figure>
                    <img class="rounded-t-xl h-40 w-full object-cover" src="{{ asset('img/home/contenido_home_1.jpg') }}" alt="Cursos">
                </figure>
                <div class="p-6">
                    <header class="mb-4">
                        <h2 class="text-center text-2xl text-gray-800 font-semibold">Cursos</h2>
                    </header>
                    <p class="text-sm text-gray-600 leading-relaxed">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ipsa error, voluptatibus iste tempore non, sequi quia tenetur nulla nobis explicabo.</p>
                </div>
            </article>
    
            <!-- Promociones Section -->
            <article class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <figure>
                    <img class="rounded-t-xl h-40 w-full object-cover" src="{{ asset('img/home/contenido_home_2.jpg') }}" alt="Promociones">
                </figure>
                <div class="p-6">
                    <header class="mb-4">
                        <h2 class="text-center text-2xl text-gray-800 font-semibold">Promociones</h2>
                    </header>
                    <p class="text-sm text-gray-600 leading-relaxed">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ipsa error, voluptatibus iste tempore non, sequi quia tenetur nulla nobis explicabo.</p>
                </div>
            </article>
    
            <!-- Dar Clases Section -->
            <article class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <figure>
                    <img class="rounded-t-xl h-40 w-full object-cover" src="{{ asset('img/home/contenido_home_3.jpg') }}" alt="Dar Clases">
                </figure>
                <div class="p-6">
                    <header class="mb-4">
                        <h2 class="text-center text-2xl text-gray-800 font-semibold">¿Quieres dar Clases?</h2>
                    </header>
                    <p class="text-sm text-gray-600 leading-relaxed">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores ipsa error, voluptatibus iste tempore non, sequi quia tenetur nulla nobis explicabo.</p>
                </div>
            </article>
        </div>
    </section>

    <!-- Seccion Catalogo Cursos -->
    <section class="mt-24 bg-gray-800 py-12">
        <h2 class="text-center text-white text-3xl font-bold">Las oportunidades no esperan, ¡tú tampoco deberías!</h2>
        <p class="text-center text-white text-xl mt-4">¡Comienza tu aprendizaje hoy mismo!</p>

        <div class="flex justify-center mt-6">
            <a href="{{ route('courses.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-300">
                Catálogo de Cursos
            </a>
        </div>
    </section>

    @php
        $sections = [
            ['title' => 'Últimos Cursos', 'courses' => $courses],
            ['title' => 'Cursos Populares', 'courses' => $popularCourses],
            ['title' => 'Cursos más Comprados', 'courses' => $mostPurchasedCourses],
        ];
    @endphp

    @foreach ($sections as $section)
        <section class="mt-24">
            <h2 class="text-center text-4xl text-gray-800 font-bold">{{ $section['title'] }}</h2>
            <p class="text-center text-gray-500 text-lg mt-4 mb-10">
                Transforma tu pasión en una profesión. ¡El conocimiento es tu mejor inversión!
            </p>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <!-- Swiper Container -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($section['courses'] as $course)
                            <div class="swiper-slide">
                                <x-course-card :course="$course" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones de navegación personalizados -->
                <button class="custom-prev rounded-full w-10 h-10 bg-white shadow-lg flex items-center justify-center text-blue-600 transition-all hover:bg-blue-50 absolute z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button class="custom-next rounded-full w-10 h-10 bg-white shadow-lg flex items-center justify-center text-blue-600 transition-all hover:bg-blue-50 absolute z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </section>
    @endforeach

    <section class="flex flex-wrap lg:flex-nowrap bg-gray-800 text-white mt-24 min-h-[400px]">
        <!-- Fondo artístico -->
        <div class="w-full lg:w-1/2 h-96 lg:h-auto" 
            style="background-image: url({{ asset('img/home/scentia_home.jpg') }}); background-size: cover; background-position: center;">
        </div>
    
        <!-- Información de Resumen -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-gray-700 py-12 sm:px-8 lg:px-16">
            <!-- Título y Descripción -->
            <h2 class="text-3xl font-bold uppercase tracking-wide">Resumen de la web</h2>
            <p class="mt-4 text-base text-gray-300">La formación online es el presente</p>
            <div class="w-20 h-1 bg-red-500 my-6"></div>
    
            <!-- Contenedor de estadísticas -->
            <div class="grid grid-cols-2 gap-6 text-center mt-8">
                <!-- Cursos -->
                <div class="bg-gray-800 border border-gray-600 rounded-lg p-8 hover:shadow-lg transition duration-300 ease-in-out">
                    <span class="text-5xl font-bold text-gray-200">35</span>
                    <p class="mt-4 text-lg text-gray-300">Cursos</p>
                </div>
                <!-- Estudiantes -->
                <div class="bg-gray-800 border border-gray-600 rounded-lg p-8 hover:shadow-lg transition duration-300 ease-in-out">
                    <span class="text-5xl font-bold text-gray-200">142</span>
                    <p class="mt-4 text-lg text-gray-300">Estudiantes</p>
                </div>
            </div>
        </div>
    </section>
    

    <section class="bg-gray-100 mt-24">
        <div class="container mx-auto px-6">
            <h2 class="text-center text-4xl text-gray-800 font-bold">Reseñas Populares</h2>
            <p class="text-center text-gray-500 text-lg mt-4 mb-10">
                Mira lo que opinan algunos de nuestros estudiantes
            </p>
    
            <!-- Slider Principal -->
            <div class="swiper mySwiper relative">
                <div class="swiper-wrapper">
                    @foreach ($reviews as $review)
                        <div class="swiper-slide bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                            <!-- Imagen de perfil -->
                            <img class="w-20 h-20 rounded-full mb-4 border-2 border-blue-500" 
                                 src="{{ $review->user->profile_photo_url ? asset($review->user->profile_photo_url) : asset('default-avatar.png') }}" 
                                 alt="{{ $review->user->name }}">
                            <!-- Nombre del usuario -->
                            <h3 class="font-semibold text-lg text-gray-800">{{ $review->user->name }}</h3>
                            <!-- Nombre del curso -->
                            <p class="text-sm text-gray-500 mt-2">
                                <strong>Curso:</strong> {{ $review->course->title }}
                            </p>
                            <!-- Comentario -->
                            <p class="mt-4 text-gray-600 text-center italic">"{{ $review->comment }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <x-footer />

    <!-- Inicialización de Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sliders = document.querySelectorAll('.swiper-container');

            sliders.forEach((slider) => {
                new Swiper(slider, {
                    slidesPerView: 1, // Mostrar 4 tarjetas por fila
                    spaceBetween: 16, // Espaciado entre tarjetas
                    breakpoints: {
                        640: {
                            slidesPerView: 1, // Mostrar 1 tarjeta en pantallas pequeñas
                        },
                        768: {
                            slidesPerView: 2, // Mostrar 2 tarjetas en pantallas medianas
                        },
                        1024: {
                            slidesPerView: 3, // Mostrar 3 tarjetas en pantallas grandes
                        },
                        1200: {
                            slidesPerView: 4, // Mostrar 3 tarjetas en pantallas grandes
                        },
                    },
                    loop: false, // No repetir contenido
                    navigation: {
                        nextEl: slider.closest('section').querySelector('.custom-next'), // Botón personalizado
                        prevEl: slider.closest('section').querySelector('.custom-prev'), // Botón personalizado
                    },
                });
            });
        });

        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 1, // Muestra una diapositiva a la vez
            spaceBetween: 20, // Espaciado entre las diapositivas
            navigation: {
                nextEl: '.swiper-button-next', // Botón "Next"
                prevEl: '.swiper-button-prev', // Botón "Previous"
            },
            loop: true, // Hace que el slider se repita en un bucle
            autoplay: {
                delay: 5000, // Cambia cada 5 segundos (opcional)
            },
        });
    </script>

    <!-- Estilos Personalizados -->
    <style>
        .swiper-container {
            overflow: hidden; /* Ocultar contenido que no está visible */
        }

        .swiper-slide {
            flex-shrink: 0;
            width: 25%; /* Mostrar 4 tarjetas */
            box-sizing: border-box;
            padding: 0.5rem; /* Espaciado entre tarjetas */
        }

        /* Ocultar las flechas por defecto de Swiper */
        .swiper-button-prev,
        .swiper-button-next {
            display: none !important;
        }

        /* Posicionar las flechas personalizadas */
        .custom-prev,
        .custom-next {
            top: 50%;
            transform: translateY(-50%);
        }

        .custom-prev {
            left: 0; /* Alinear a la izquierda del contenedor */
            margin-left: 1.5rem; /* Separación interna */
        }

        .custom-next {
            right: 0; /* Alinear a la derecha del contenedor */
            margin-right: 1.5rem; /* Separación interna */
        }

        /* Ajustar tamaños y estilos */
        .custom-prev, .custom-next {
            width: 2.5rem; /* Tamaño del círculo */
            height: 2.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
            color: #1D4ED8; /* Azul Tailwind */
        }

        .custom-prev:hover,
        .custom-next:hover {
            background-color: #EFF6FF; /* Azul claro en hover */
            color: #2563EB; /* Azul más intenso */
        }
    </style>

</x-app-layout>

