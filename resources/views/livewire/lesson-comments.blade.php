<section class="mt-6">
    <h1 class="text-2xl font-extrabold text-gray-800 mb-6">Comentarios</h1>

    {{-- Formulario de nuevo comentario --}}
    @auth
        <div class="mb-6 bg-white p-4 rounded-lg shadow-md">
            <textarea wire:model="commentText"
                      class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      placeholder="Escribe un comentario..."></textarea>
            @error('commentText')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror

            <div class="flex justify-end mt-2">
                <button wire:click="store"
                        class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">
                    Publicar
                </button>
            </div>
        </div>
    @endauth

    {{-- Listado de comentarios --}}
    <div class="space-y-6">
        @forelse ($comments as $comment)
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <div class="flex items-start space-x-3">
                    <img src="{{ $comment->user->profile_photo_url }}"
                         alt="Foto de {{ $comment->user->name }}"
                         class="h-10 w-10 rounded-full object-cover shadow">

                    <div class="flex-1">
                        <div class="flex items-center space-x-2">
                            <h3 class="font-semibold text-gray-800">{{ $comment->user->name }}</h3>
                            {{-- Etiqueta de instructor --}}
                            @if ($comment->user->id === $course->teacher->id)
                                <span class="px-2 py-0.5 text-xs font-bold bg-yellow-100 text-yellow-700 rounded-full">
                                    Instructor
                                </span>
                            @endif
                        </div>

                        <p class="text-gray-600 text-sm mt-1">{{ $comment->name }}</p>

                        {{-- Botón responder --}}
                        @auth
                            <button wire:click="$set('replyTo', {{ $comment->id }})"
                                    class="text-xs text-indigo-600 mt-2 hover:underline">
                                Responder
                            </button>
                        @endauth

                        {{-- Formulario de respuesta --}}
                        @if ($replyTo === $comment->id)
                            <div class="mt-3">
                                <textarea wire:model="replyText"
                                          class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                          placeholder="Escribe una respuesta..."></textarea>
                                @error('replyText')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror

                                <div class="flex space-x-2 mt-2">
                                    <button wire:click="reply({{ $comment->id }})"
                                            class="px-3 py-1 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600">
                                        Responder
                                    </button>
                                    <button wire:click="cancelReply"
                                            class="px-3 py-1 bg-gray-300 text-gray-800 text-sm rounded-lg hover:bg-gray-400">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        @endif

                        {{-- Respuestas --}}
                        @if ($comment->replies->isNotEmpty())
                            <div class="mt-4 space-y-3 border-l-2 border-gray-200 pl-4">
                                @foreach ($comment->replies as $reply)
                                    <div class="flex items-start space-x-3 {{ $reply->user->id === $course->teacher->id ? 'bg-yellow-50 p-2 rounded-md' : '' }}">
                                        <img src="{{ $reply->user->profile_photo_url }}"
                                             alt="Foto de {{ $reply->user->name }}"
                                             class="h-8 w-8 rounded-full object-cover shadow">

                                        <div>
                                            <div class="flex items-center space-x-2">
                                                <h4 class="font-semibold text-gray-700 text-sm">{{ $reply->user->name }}</h4>
                                                {{-- Etiqueta instructor --}}
                                                @if ($reply->user->id === $course->teacher->id)
                                                    <span class="px-2 py-0.5 text-xs font-bold bg-yellow-100 text-yellow-700 rounded-full">
                                                        Instructor
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-gray-600 text-sm">{{ $reply->name }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center">Aún no hay comentarios en esta lección.</p>
        @endforelse
    </div>
</section>
