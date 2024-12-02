{{-- <section class="mt-4">
    <h1 class="font-bold text-3xl mb-4">Resena de los estudiantes</h1>

    
    <div class="flex">
        <div class="text-center">
            <p class="text-4xl ">4.5</p>
            <ul class="flex space-x-2 text-yellow-400 text-sm">
                @for ($i = 1; $i <= 5; $i++)
                    <li class="cursor-pointer" wire:click="$set('rating', {{ $i }})">
                        <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    </li>
                @endfor
            </ul>
            <p>Valoraciones</p>

        </div>
        <div class="ml-4">
            <div class="flex items-center mt-4">
                
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 70%"></div>
                </div>
                <ul class="flex space-x-2 text-yellow-400 text-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="cursor-pointer" wire:click="$set('rating', {{ $i }})">
                            <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        </li>
                    @endfor
                </ul>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">70%</span>
            </div>
            <div class="flex items-center mt-4">
                
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 17%"></div>
                </div>
                <ul class="flex space-x-2 text-yellow-400 text-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="cursor-pointer" wire:click="$set('rating', {{ $i }})">
                            <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        </li>
                    @endfor
                </ul>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">17%</span>
            </div>
            <div class="flex items-center mt-4">
                
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 8%"></div>
                </div>
                <ul class="flex space-x-2 text-yellow-400 text-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="cursor-pointer" wire:click="$set('rating', {{ $i }})">
                            <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        </li>
                    @endfor
                </ul>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8%</span>
            </div>
            <div class="flex items-center mt-4">
                
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 4%"></div>
                </div>
                <ul class="flex space-x-2 text-yellow-400 text-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="cursor-pointer" wire:click="$set('rating', {{ $i }})">
                            <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        </li>
                    @endfor
                </ul>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">4%</span>
            </div>
            <div class="flex items-center mt-4">
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 1%"></div>
                </div>
                <ul class="flex space-x-2 text-yellow-400 text-sm">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="cursor-pointer" wire:click="$set('rating', {{ $i }})">
                            <i class="fas fa-star {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        </li>
                    @endfor
                </ul>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">1%</span>
            </div>
        </div>
    </div>

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
</section> --}}
<section class="mt-6">
    <h1 class="text-2xl font-extrabold text-gray-800 mb-6">Reseñas de los estudiantes</h1>

    {{-- Valoración general --}}
    <div class="flex flex-col sm:flex-row items-center gap-6 bg-gray-50 p-6 rounded-lg shadow-md">
        {{-- Promedio general --}}
        <div class="text-center">
            <p class="text-5xl font-bold text-yellow-400">{{ number_format($averageRating, 1) }}</p>
            <div class="flex justify-center mt-2">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                @endfor
            </div>
            <p class="text-xs text-gray-600 mt-2">{{ $totalReviews }} Valoraciones</p>
        </div>

        {{-- Porcentaje de valoraciones --}}
        <div class="w-full space-y-2">
            @foreach ([5, 4, 3, 2, 1] as $stars)
                <div class="flex items-center">                    
                    {{-- Barra de porcentaje --}}
                    <div class="flex-1 mx-4 bg-gray-200 h-4 rounded-lg overflow-hidden">
                        <div class="bg-yellow-400 h-full" style="width: {{ $ratingPercentages[$stars] ?? 0 }}%;"></div>
                    </div>

                    {{-- Estrellas dinámicas --}}
                    <ul class="flex space-x-1 text-sm">
                        @for ($i = 1; $i <= 5; $i++)
                            <li>
                                <i class="fas fa-star {{ $i <= $stars ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            </li>
                        @endfor
                    </ul>

                    {{-- Porcentaje al final --}}
                    <span class="ml-4 text-right text-sm font-medium text-gray-600">
                        {{ $ratingPercentages[$stars] ?? 0 }}%
                    </span>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Formulario de reseña (solo si el usuario está inscrito y no ha valorado aún) --}}
    @can('enrolled', $course)
        @can('valued', $course)
            <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Deja tu reseña</h2>
                <textarea wire:model="comment" 
                          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                          placeholder="Escribe tu reseña sobre este curso..."></textarea>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex space-x-2 text-lg">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star cursor-pointer {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                               wire:click="$set('rating', {{ $i }})"></i>
                        @endfor
                    </div>
                    <button wire:click="store" 
                            class="px-4 py-2 bg-indigo-500 text-white font-semibold rounded-lg hover:bg-indigo-600">
                        Guardar reseña
                    </button>
                </div>
            </div>
        @else
            <div class="mt-6 bg-blue-100 text-blue-600 p-4 rounded-lg shadow-md">
                <p>Ya has enviado tu reseña para este curso. ¡Gracias por tu aporte!</p>
            </div>
        @endcan
    @endcan

    {{-- Listado de reseñas --}}
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Reseñas</h2>
        @if ($course->reviews->isNotEmpty())
            <div class="space-y-4">
                @foreach ($course->reviews as $review)
                    <div class="flex items-start space-x-4 bg-white p-4 rounded-lg shadow-md">
                        <img src="{{ $review->user->profile_photo_url }}" 
                             alt="Foto de {{ $review->user->name }}" 
                             class="h-12 w-12 rounded-full object-cover shadow">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-800">{{ $review->user->name }}</h3>
                                <div class="flex items-center space-x-1 text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">{{ $review->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">Aún no hay valoraciones para este curso.</p>
        @endif
    </div>
</section>

