<x-app-layout>
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6 max-w-3xl bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-4xl font-bold text-gray-800 text-center mb-6">Dicta una Clase</h1>
            <p class="text-lg text-gray-600 text-center mb-8">
                ¿Tienes conocimientos que deseas compartir? Envíanos tu solicitud y únete a nuestra plataforma como instructor.
            </p>

            <!-- Formulario de contacto -->
            <form action="{{ route('instructor.request') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nombre Completo -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Nombre Completo:</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Número de Celular -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-semibold">Número de Celular:</label>
                    <input type="tel" id="phone" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Correo Electrónico -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Descripción del Curso -->
                <div class="mb-4">
                    <label for="course_description" class="block text-gray-700 font-semibold">Descripción del Curso:</label>
                    <textarea id="course_description" name="course_description" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Carga de Documento (Currículum) -->
                <div class="mb-4">
                    <label for="curriculum" class="block text-gray-700 font-semibold">Adjuntar Currículum y plan del curso (PDF):</label>
                    <input type="file" id="curriculum" name="curriculum" accept=".pdf" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Botón de Envío -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />
</x-app-layout>
