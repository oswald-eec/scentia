<section class="mt-4">
    <h1 class="font-bold text-3xl mb-4">Valoración</h1>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4">
            
            @can('enrolled', $course)
                <article class="mb-4">
                    @can('valued', $course)
                        <div class="mb-4">
                            <textarea wire:model="comment" 
                                      class="form-input w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" 
                                      placeholder="Ingrese una reseña del curso"></textarea>
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="px-4 py-2 bg-indigo-500 text-white font-bold rounded-lg hover:bg-indigo-600 transition duration-300" 
                                    wire:click="store">
                                Guardar
                            </button>

                            <ul class="flex space-x-2 text-yellow-400 text-lg">
                                @for ($i = 1; $i <= 5; $i++)
                                    <li class="cursor-pointer" wire:click="$set('rating', {{ $i }})">
                                        <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    @else
                        <div class="flex items-center bg-blue-500 text-white text-sm font-semibold px-4 py-3 rounded-lg shadow-md mt-4" role="alert">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                            </svg>
                            <p>Usted ya envió su reseña</p>
                        </div>
                    @endcan
                </article>
            @endcan

            @if ($course->reviews->isNotEmpty())
                @foreach ($course->reviews as $review)
                    <article class="flex items-start mb-4">
                        <figure class="mr-4">
                            <img class="h-12 w-12 object-cover rounded-full shadow-md" 
                                 src="{{ $review->user->profile_photo_url }}" 
                                 alt="Foto de {{ $review->user->name }}" loading="lazy">
                        </figure>
                        <div class="bg-white shadow-md rounded-lg overflow-hidden flex-1">
                            <div class="px-6 py-4 bg-gray-100">
                                <p class="font-bold text-gray-800">
                                    {{ $review->user->name }} 
                                    <span class="text-yellow-400">
                                        <i class="fas fa-star"></i> ({{ $review->rating }})
                                    </span>
                                </p>
                                <p class="text-gray-700 mt-2">{{ $review->comment }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <p class="text-gray-500 text-center mt-4">Aún no hay valoraciones para este curso.</p>
            @endif
        </div>
    </div>
</section>
