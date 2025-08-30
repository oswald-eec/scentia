<div>
    <h1 class="text-2xl font-bold mb-4">Certificado - {{ $student->name }}</h1>

    @if($certificate)
        <p class="text-green-600">Ya existe un certificado subido.</p>
        <a href="{{ Storage::url($certificate->file_path) }}" target="_blank" class="text-blue-600 underline">Ver certificado</a>
    @endif

    <form wire:submit.prevent="uploadCertificate" class="mt-4">
        <input type="file" wire:model="certificateFile">
        <button type="submit" class="btn btn-primary mt-2">Subir certificado</button>
    </form>
</div>
