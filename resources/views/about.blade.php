<x-app-layout>
    <section class="bg-blue-50 py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-8">Sobre Nosotros</h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">Nuestra misión es ofrecerte un espacio donde puedas desarrollar nuevas habilidades y conocimientos, mejorando tu vida profesional y personal. Con una amplia variedad de cursos online, nos comprometemos a brindarte los mejores recursos para que aprendas a tu propio ritmo y desde cualquier lugar.</p>

            <!-- Imagen destacada -->
            <div class="relative mb-8">
                <img src="{{ asset('img/home/about-us.jpg') }}" alt="Imagen sobre nosotros" class="w-full h-auto rounded-lg shadow-lg">
            </div>

            <!-- Sección de Misión -->
            <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0 md:space-x-6">
                <div class="flex-1 text-left space-y-4">
                    <h2 class="text-3xl font-semibold text-gray-800">Nuestra Misión</h2>
                    <p class="text-lg text-gray-600">En Scientia, ofrecemos cursos online en diversas áreas como carpintería, electricidad, programación, escritura y más. Creemos que cada persona tiene el potencial de aprender y crecer, por eso diseñamos nuestros cursos para ser accesibles, prácticos y flexibles, ayudando a nuestros estudiantes a alcanzar sus objetivos profesionales y personales.</p>
                </div>
                <div class="flex-1 text-left space-y-4">
                    <h2 class="text-3xl font-semibold text-gray-800">¿Por qué elegirnos?</h2>
                    <ul class="list-disc list-inside text-lg text-gray-600 space-y-2">
                        <li>Variedad de cursos en múltiples áreas: Desde carpintería hasta programación.</li>
                        <li>Flexibilidad para aprender a tu propio ritmo, sin importar el lugar.</li>
                        <li>Acceso a materiales de alta calidad y docentes expertos en sus campos.</li>
                        <li>Plataforma intuitiva, diseñada para facilitar tu aprendizaje.</li>
                    </ul>
                </div>
            </div>

            <!-- Sección de Visión -->
            <div class="my-12 px-6">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4 text-center">Nuestra Visión</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto text-center">Ser la plataforma educativa líder en línea que ofrece un acceso fácil, rápido y asequible a cursos de alta calidad, ayudando a las personas de todo el mundo a adquirir nuevas habilidades y avanzar en sus carreras profesionales.</p>
            </div>

            <!-- Imagen de equipo (opcional) -->
            <div class="relative mb-8">
                <img src="{{ asset('img/home/team.jpg') }}" alt="Nuestro equipo" class="w-full h-auto rounded-lg shadow-lg">
            </div>
        </div>
    </section>
</x-app-layout>