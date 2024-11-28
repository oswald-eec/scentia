<!-- resources/views/components/footer.blade.php -->
<footer class="bg-gray-900 text-white py-12 mt-24 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <h3 class="text-lg font-bold">Nosotros</h3>
            <a href="{{ route('contact.index') }}" class="block text-gray-400 mt-2">Contáctanos</a>
        </div>
        <div>
            <h3 class="text-lg font-bold">Enlaces Útiles</h3>
            <a href="#" class="block text-gray-400 mt-2">Términos y Condiciones</a>
        </div>
        <div>
            <h3 class="text-lg font-bold">Explora</h3>
            <a href="#" class="block text-gray-400 mt-2">Categorías</a>
        </div>
        <div>
            <h3 class="text-lg font-bold">Redes Sociales</h3>
            <div class="mt-4">
                <a href="#" class="mr-3 text-gray-400"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="mr-3 text-gray-400"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <div class="text-center mt-8 text-gray-400 text-sm">&copy; 2024 Scientia. Todos los derechos reservados.</div>
</footer>
