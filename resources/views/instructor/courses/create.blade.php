<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h1 class="text-2xl font-bold">CREAR NUEVO CURSO</h1>

                <hr class="mt-2 mb-6">

                {!! Form::open(['route' => 'instructor.courses.store', 'files'=>true]) !!}

                    {!! Form::hidden('user_id', auth()->user()->id) !!}

                    @include('instructor.courses.partials.form')

                    <!-- Botón de actualización -->
                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('instructor.courses.index') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Volver</a>
                        {!! Form::submit('Crear nuevo curso', ['class' => 'bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

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
</x-app-layout>