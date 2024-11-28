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

    <!-- JavaScript para el slug y la previsualización de imagen -->
    <x-slot name="js">
        <script>
            // Función para generar el slug a partir del título
            document.getElementById("title").addEventListener('keyup', function() {
                let title = this.value.trim();
                document.getElementById("slug").value = slugify(title);
            });

            function slugify(str) {
                return str.toLowerCase().trim().replace(/[\s\W-]+/g, '-').replace(/^-+|-+$/g, '');
            }

            // Función para previsualizar imagen al seleccionar un archivo
            document.getElementById("file").addEventListener('change', cambiarImagen);
            function cambiarImagen(event) {
                var file = event.target.files[0];
                var reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById("picture").setAttribute('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
        </script>
    </x-slot>
</x-instructor-layout>
