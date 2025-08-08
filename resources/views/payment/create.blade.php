<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-12">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Subir Comprobante de Pago - AirTM</h1>

        <!-- Resumen del curso -->
        <div class="bg-white shadow rounded-lg p-6 mb-6 text-gray-700">
            <div class="flex items-center mb-4">
                <img 
                    src="{{ asset('storage/' . $course->image->url) }}" 
                    class="h-20 w-20 object-cover rounded shadow-sm" 
                    alt="Imagen del curso {{ $course->title }}"
                    loading="lazy">

                <div class="ml-4">
                    <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                    <p class="text-gray-500 text-sm">Impartido por: {{ $course->teacher->name }}</p>
                </div>

                <p class="ml-auto text-2xl font-bold text-gray-800">
                    Bs {{ number_format($course->price->value, 2) }}
                </p>
            </div>

            <!-- Instrucciones -->
            <div class="bg-gray-50 p-4 border rounded text-sm text-gray-600">
                <p><strong>Instrucciones:</strong></p>
                <ul class="list-disc list-inside mt-2 space-y-1">
                    <li>Realiza el pago vía <strong>AirTM</strong> al correo: <strong class="text-blue-600">admin@scientia.com</strong></li>
                    <li>El monto exacto es: <strong>Bs {{ number_format($course->price->value, 2) }}</strong></li>
                    <li>En la nota escribe: <strong>Curso: {{ $course->title }} - [Tu Email]</strong>.</li>
                    <li>Una vez realizado el pago, sube la imagen del comprobante (captura de pantalla).</li>
                    <li>Tu inscripción será validada manualmente en las próximas horas.</li>
                </ul>
            </div>
        </div>

        <!-- Formulario de comprobante -->
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('manual.payment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campos ocultos -->
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="amount" value="{{ $course->price->value }}">

                <!-- Campo de imagen -->
                <div class="mb-4">
                    <label for="proof" class="block text-sm font-medium text-gray-700 mb-2">Comprobante de pago (imagen)</label>
                    <input 
                        type="file" 
                        name="proof" 
                        id="proof" 
                        required 
                        accept="image/*"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">

                    @error('proof')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón de enviar -->
                <div class="flex justify-end">
                    <button 
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow transition duration-300">
                        Enviar Comprobante
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Footer -->
    <x-footer />
</x-app-layout>
