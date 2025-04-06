<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-12">
        <!-- Título del curso -->
        <h1 class="text-gray-700 text-3xl font-extrabold mb-6">{{ $course->title }}</h1>
        
        <div class="bg-white shadow-lg rounded-lg overflow-hidden text-gray-700">
            <div class="px-6 py-6">
                <!-- Información del curso -->
                <article class="flex items-center mb-4">
                    <!-- Imagen del curso -->
                    <img 
                        src="{{ asset('storage/' . $course->image->url) }}" 
                        class="h-16 w-16 object-cover rounded-md shadow-sm" 
                        alt="Imagen del curso {{ $course->title }}" 
                        loading="lazy">

                    <!-- Título del curso -->
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                        <p class="text-gray-500 text-sm">Impartido por: {{ $course->teacher->name }}</p>
                    </div>

                    <!-- Precio -->
                    <p class="text-2xl font-bold text-gray-900 ml-auto">
                        Bs {{ number_format($course->price->value, 2) }}
                    </p>
                </article>

                <!-- Botón de compra -->
                <div class="flex justify-end">
                    <a 
                        href="{{ $course->hotmart_link }}" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-sm transition duration-300">
                        Comprar este curso
                    </a>
                </div>

                <!-- Línea divisoria -->
                <hr class="my-6 border-gray-200">

                <!-- Términos y condiciones -->
                <p class="text-sm text-center">
                    Al comprar este curso, aceptas nuestros 
                    <a href="{{ route('terms') }}" class="text-red-500 hover:underline">Términos y Condiciones</a>.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
