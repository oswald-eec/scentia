<x-app-layout>
    
    {{-- Seccion Portada --}}
    <section >
        <div >
            <div x-data="{            
                // Configuración de tiempo entre diapositivas en milisegundos
                autoplayIntervalTime: 4000,
                slides: [                
                    {
                        imgSrc: '{{ asset('img/home/scentia_home.jpg') }}',
                        imgAlt: 'Descuento de 20 USD por compra de 5 cursos.',  
                        title: '20 USD Dcto por la compra de 5 cursos',
                        description: 'Aprender lo que más te gusta, nunca tan sencillo y económico',           
                    },                
                    {                    
                        imgSrc: '{{ asset('img/home/scentia_home_1.jpg') }}',
                        imgAlt: 'Descuento del 50% en cursos de programación',  
                        title: '50% Dcto en todos los cursos de programación',
                        description: 'Conviértete en desarrollador con nuestros cursos a mitad de precio',            
                    },                
                    {                    
                        imgSrc: '{{ asset('img/home/scentia_home_2.jpg') }}',
                        imgAlt: 'Acceso ilimitado por 3 meses',    
                        title: '3 meses de acceso ilimitado por solo 30 USD',
                        description: 'Aprovecha nuestra oferta exclusiva por tiempo limitado',       
                    },            
                ],            
                currentSlideIndex: 1,
                isPaused: false,
                autoplayInterval: null,
                // Función para ir a la diapositiva anterior
                previous() {                
                    if (this.currentSlideIndex > 1) {                    
                        this.currentSlideIndex = this.currentSlideIndex - 1                
                    } else {                    
                        this.currentSlideIndex = this.slides.length                
                    }            
                },            
                // Función para avanzar a la siguiente diapositiva
                next() {                
                    if (this.currentSlideIndex < this.slides.length) {                    
                        this.currentSlideIndex = this.currentSlideIndex + 1                
                    } else {                    
                        this.currentSlideIndex = 1                
                    }            
                },    
                // Función para activar el autoplay
                autoplay() {
                    this.autoplayInterval = setInterval(() => {
                        if (!this.isPaused) {
                            this.next()
                        }
                    }, this.autoplayIntervalTime)
                },
                // Actualiza el tiempo de intervalo de autoplay
                setAutoplayInterval(newIntervalTime) {
                    clearInterval(this.autoplayInterval)
                    this.autoplayIntervalTime = newIntervalTime
                    this.autoplay()
                },    
            }" x-init="autoplay" class="relative w-full overflow-hidden">
       
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

    {{-- <!-- Sección Últimos Cursos -->
    <section class="mt-24">
        <h2 class="text-center text-4xl text-gray-800 font-bold">Últimos Cursos</h2>
        <p class="text-center text-gray-500 text-lg mt-4 mb-10">Transforma tu pasión en una profesión. ¡El conocimiento es tu mejor inversión!</p>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div x-data="{ current: 0, total: {{ count($courses) }} }" class="relative">

                <!-- Carrusel de Tarjetas -->
                <div class="overflow-hidden relative max-w-7xl mx-auto">
                    <!-- Botón de desplazamiento izquierdo -->
                    <button @click="current = current === 0 ? Math.floor(total / 4) - 1 : current - 1"
                            class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </svg>
                    </button>

                    <!-- Contenedor de Tarjetas -->
                    <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (current * 100) + '%)'">
                        @foreach ($courses as $course)
                            <div class="min-w-[25%] p-4 flex-shrink-0">
                                <!-- Uso del componente del curso -->
                                <x-course-card :course="$course" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de desplazamiento derecho -->
                    <button @click="current = (current + 1) % Math.ceil(total / 4)"
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Cursos Populares -->
    <section class="mt-24">
        <h2 class="text-center text-4xl text-gray-800 font-bold">Cursos Populares</h2>
        <p class="text-center text-gray-500 text-lg mt-4 mb-10">
            Transforma tu pasión en una profesión. ¡El conocimiento es tu mejor inversión!
        </p>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div x-data="{ current: 0, total: {{ count($popularCourses) }} }" class="relative">

                <!-- Carrusel de Tarjetas -->
                <div class="overflow-hidden relative max-w-7xl mx-auto">
                    <!-- Botón de desplazamiento izquierdo -->
                    <button @click="current = current === 0 ? Math.ceil(total / 4) - 1 : current - 1"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>

                    <!-- Contenedor de Tarjetas -->
                    <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (current * 100) + '%)'"><!--
                        -->@foreach ($popularCourses as $course)
                            <div class="min-w-[25%] p-4 flex-shrink-0">
                                <x-course-card :course="$course" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de desplazamiento derecho -->
                    <button @click="current = (current + 1) % Math.ceil(total / 4)"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Cursos más Comprados -->
    <section class="mt-24">
        <h2 class="text-center text-4xl text-gray-800 font-bold">Cursos más Comprados</h2>
        <p class="text-center text-gray-500 text-lg mt-4 mb-10">
            Transforma tu pasión en una profesión. ¡El conocimiento es tu mejor inversión!
        </p>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div x-data="{ current: 0, total: {{ count($mostPurchasedCourses) }} }" class="relative">

                <!-- Carrusel de Tarjetas -->
                <div class="overflow-hidden relative max-w-7xl mx-auto">
                    <!-- Botón de desplazamiento izquierdo -->
                    <button @click="current = current === 0 ? Math.ceil(total / 4) - 1 : current - 1"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>

                    <!-- Contenedor de Tarjetas -->
                    <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (current * 100) + '%)'"><!--
                        -->@foreach ($mostPurchasedCourses as $course)
                            <div class="min-w-[25%] p-4 flex-shrink-0">
                                <x-course-card :course="$course" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón de desplazamiento derecho -->
                    <button @click="current = (current + 1) % Math.ceil(total / 4)"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Reutilización del Carrusel -->
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
                <div x-data="{ current: 0, items: {{ count($section['courses']) }} }" class="relative">

                    <!-- Botón de desplazamiento izquierdo -->
                    <button @click="current = current === 0 ? Math.ceil(items / 4) - 1 : current - 1"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>

                    <!-- Contenedor de Tarjetas -->
                    <div class="overflow-hidden relative">
                        <div class="flex transition-transform duration-500 ease-in-out" 
                             :style="'transform: translateX(-' + (current * 100) + '%)'">
                            @foreach ($section['courses'] as $course)
                                <div class="min-w-[100%] sm:min-w-[50%] md:min-w-[33.33%] lg:min-w-[25%] p-4 flex-shrink-0">
                                    <x-course-card :course="$course" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Botón de desplazamiento derecho -->
                    <button @click="current = (current + 1) % Math.ceil(items / 4)"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white text-gray-700 p-3 rounded-full shadow-lg hover:bg-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    @endforeach

    <!-- Footer -->
    <x-footer />

</x-app-layout>

