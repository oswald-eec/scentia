<x-instructor-layout :course="$course">
    <h1 class="text-2xl font-bold text-gray-700">Información del Curso</h1>
    <hr class="mt-2 mb-6">
    
    {!! Form::model($course, ['route' => ['instructor.courses.update', $course], 'method' => 'put', 'class' => 'space-y-6', 'files' => true]) !!}

    @include('instructor.courses.partials.form')

    <!-- Botón de actualización -->
    <div class="flex justify-end mt-6 space-x-4">
        <a href="{{ route('instructor.courses.index') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Volver</a>
        {!! Form::submit('Actualizar', ['class' => 'cursor-pointer bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg']) !!}
    </div>

    {!! Form::close() !!}

    <!-- JavaScript para funcionalidades interactivas -->
    <x-slot name="js">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Generación automática del slug
                const titleInput = document.getElementById('title');
                const slugInput = document.getElementById('slug');
                titleInput?.addEventListener('input', () => {
                    slugInput.value = slugify(titleInput.value);
                });

                function slugify(text) {
                    return text
                        .toLowerCase()
                        .trim()
                        .replace(/[\s\W-]+/g, '-') // Reemplaza espacios y caracteres especiales con '-'
                        .replace(/^-+|-+$/g, '');  // Elimina guiones iniciales y finales
                }

                // Previsualización de la imagen seleccionada
                const fileInput = document.getElementById('file');
                const picturePreview = document.getElementById('picture');
                fileInput?.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            picturePreview.setAttribute('src', e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    </x-slot>
</x-instructor-layout>
