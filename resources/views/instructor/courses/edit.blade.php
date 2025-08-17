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
    {{-- <x-slot name="js">
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
    </x-slot> --}}
    <x-slot name="js">
        <script>
            // ====== SLUG (lo tuyo existente) ======
            document.getElementById("title").addEventListener('keyup', function() {
                let title = this.value.trim();
                document.getElementById("slug").value = slugify(title);
            });
            function slugify(str) {
                return str.toLowerCase().trim().replace(/[\s\W-]+/g, '-').replace(/^-+|-+$/g, '');
            }

            // ====== PREVIEW IMG (lo tuyo existente) ======
            const fileInput = document.getElementById("file");
            if (fileInput) {
                fileInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.getElementById("picture");
                        if (img) img.setAttribute('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // ====== SUBCATEGORÍAS DINÁMICAS ======
            document.addEventListener('DOMContentLoaded', function () {
                const categorySelect = document.getElementById('category_id');
                const subcategorySelect = document.getElementById('subcategory_id');

                // Plantilla de URL vía route() (evita hardcodear paths)
                const urlTemplate = @json(route('instructor.courses.subcategories', ['category' => '__ID__']));

                function buildUrl(id) {
                    return urlTemplate.replace('__ID__', id);
                }

                function resetSubcategories(placeholder = 'Selecciona una subcategoría') {
                    subcategorySelect.innerHTML = `<option value="">${placeholder}</option>`;
                }

                function enableSubcategories(enable) {
                    subcategorySelect.disabled = !enable;
                }

                async function loadSubcategories(categoryId, preselect = null) {
                    resetSubcategories('Cargando...');
                    enableSubcategories(false);

                    try {
                        const res = await fetch(buildUrl(categoryId), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) throw new Error('Error HTTP ' + res.status);
                        const list = await res.json(); // [{id, name}, ...]
                        resetSubcategories();
                        list.forEach(item => {
                            const opt = document.createElement('option');
                            opt.value = item.id;
                            opt.textContent = item.name;
                            subcategorySelect.appendChild(opt);
                        });
                        if (preselect) subcategorySelect.value = preselect;
                        enableSubcategories(true);
                    } catch (e) {
                        console.error('Error cargando subcategorías:', e);
                        resetSubcategories('Error al cargar');
                        enableSubcategories(false);
                    }
                }

                // Cambio de categoría
                if (categorySelect) {
                    categorySelect.addEventListener('change', function () {
                        const categoryId = this.value;
                        if (categoryId) {
                            loadSubcategories(categoryId);
                        } else {
                            resetSubcategories();
                            enableSubcategories(false);
                        }
                    });
                }

                // Si viene de un error de validación, recargar automáticamente
                const initialCategory = "{{ old('category_id') }}";
                const initialSubcategory = "{{ old('subcategory_id') }}";
                if (initialCategory) {
                    loadSubcategories(initialCategory, initialSubcategory);
                }
            });
        </script>
    </x-slot>
</x-instructor-layout>
