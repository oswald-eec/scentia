<!-- Título del curso -->
<div class="mb-2">
    {!! Form::label('title', 'Título del curso', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
    {!! Form::text('title', null, [
        'class' => 'form-input rounded-md block w-full mt-1 mb-2 focus:ring-indigo-500 focus:border-indigo-500 ' . ($errors->has('title') ? 'border-red-600' : ''),
        'id' => 'title',
        'placeholder' => 'Ingresa el título del curso',
        'aria-describedby' => 'titleHelp',
    ]) !!}
    <small id="titleHelp" class="text-gray-500">El título debe ser claro y descriptivo.</small>
    @error('title')
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>

<!-- Slug del curso -->
<div class="mb-2">
    {!! Form::label('slug', 'Slug del curso', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
    {!! Form::text('slug', null, [
        'class' => 'form-input rounded-md block w-full mt-1 mb-2 focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('slug') ? 'border-red-600' : ''),
        'id' => 'slug',
        'placeholder' => 'Este campo se genera automáticamente',
        'readonly' => true,
    ]) !!}
    @error('slug')
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>

<!-- Subtítulo del curso -->
<div class="mb-2">
    {!! Form::label('subtitle', 'Subtítulo del curso', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
    {!! Form::text('subtitle', null, [
        'class' => 'form-input rounded-md block w-full mt-1 mb-2 focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('subtitle') ? 'border-red-600' : ''),
        'placeholder' => 'Escribe un subtítulo breve para el curso',
    ]) !!}
    @error('subtitle')
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>

<!-- Descripción del curso -->
<div class="mb-4">
    {!! Form::label('description', 'Descripción del curso', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-input rounded-md block w-full mt-1 mb-2 focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('description') ? 'border-red-600' : ''),
        'id' => 'editor',
        'placeholder' => 'Describe el contenido del curso',
    ]) !!}
    @error('description')
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>

<!-- Selección de categoría, nivel y precio -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
    <div>
        <!-- Selección de Categoría -->
        {!! Form::label('category_id', 'Categoría', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
        {!! Form::select('category_id', $categories, null, [
            'class' => 'form-input rounded-md block w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500',
            'id' => 'category_id',
            'placeholder' => 'Selecciona una categoría',
        ]) !!}
        @error('category_id')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>
    
    <!-- Subcategoría del curso -->
    <div class="mb-4">
        {!! Form::label('subcategory_id', 'Subcategoría', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
        {!! Form::select('subcategory_id', $subcategories, null, [
            'class' => 'form-input rounded-md block w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('subcategory_id') ? ' border-red-600' : ''),
            'placeholder' => 'Selecciona una subcategoría',
        ]) !!}
        @error('subcategory_id')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>
    
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
    <div>
        {!! Form::label('level_id', 'Nivel', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
        {!! Form::select('level_id', $levels, null, [
            'class' => 'form-input rounded-md block w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('level_id') ? 'border-red-600' : ''),
        ]) !!}
        @error('level_id')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>
    <div>
        {!! Form::label('price_id', 'Precio', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
        {!! Form::select('price_id', $prices, null, [
            'class' => 'form-input rounded-md block w-full mt-1 focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('price_id') ? 'border-red-600' : ''),
        ]) !!}
        @error('price_id')
            <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>
</div>

<!-- Imagen del curso -->
<div class="mb-6">
    <h2 class="font-semibold text-gray-700 mb-2">Imagen del curso</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <figure>
            <img 
                id="picture" 
                class="w-full h-64 object-cover object-center rounded-md mt-1 focus:ring-indigo-500 focus:border-indigo-500" 
                src="{{ asset($course->image->url ?? 'img/default/img_default.jpg') }}" 
                alt="Imagen del curso"
            >
        </figure>
        <div>
            {!! Form::file('file', [
                'class' => 'form-input rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('file') ? ' border-red-600' : ''),
                'id' => 'file',
                'accept' => 'image/*',
            ]) !!}
            <p class="text-sm text-gray-500 mt-1">Sube una imagen clara y relevante para tu curso. Debe cumplir con nuestros estándares de calidad para ser aceptada. Requisitos importantes: 750x500 píxeles; .jpg, .jpeg, .gif o .png. Sin texto.</p>
            @error('file')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<!-- Imagen del curso -->
<div class="mb-6">
    <h2 class="font-semibold text-gray-700 mb-2">Video promocional del curso</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <figure>
            <img 
                id="picture" 
                class="w-full h-64 object-cover object-center rounded-md mt-1 focus:ring-indigo-500 focus:border-indigo-500" 
                src="{{ asset($course->image->url ?? 'img/default/img_default.jpg') }}" 
                alt="Imagen del curso"
            >
        </figure>
        <div >
            {!! Form::label('promo_video', 'Video de promoción', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
            {!! Form::file('promo_video', [
                'class' => 'form-input rounded-md block w-full focus:ring-indigo-500 focus:border-indigo-500' . ($errors->has('promo_video') ? ' border-red-600' : ''),
                'accept' => 'video/*',
            ]) !!}
            <p class="text-sm text-gray-500 mt-1">Sube un video promocional en formato MP4, AVI o MOV (máx. 50MB).</p>
            @error('promo_video')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<hr class="mt-6 border-gray-300">
<h1 class="text-xl font-bold text-gray-800 mt-4">Método de Pago: Hotmart</h1>
<p class="text-sm text-gray-500 mt-2">
    Agrega la URL e ID del curso en Hotmart una vez que hayas cargado todo el material del curso.
</p>

<!-- Campos Hotmart -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
    <!-- URL del curso -->
    <div>
        {!! Form::label('hotmart_url', 'URL del curso', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
        {!! Form::text('hotmart_url', null, [
            'class' => 'form-input block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500',
            'placeholder' => 'https://www.hotmart.com/cursos/nombre-curso',
            'aria-describedby' => 'hotmart-url-help',
            'required' => false
        ]) !!}
        <p id="hotmart-url-help" class="text-xs text-gray-500 mt-1">Introduce la URL pública del curso en Hotmart.</p>

        @error('hotmart_url')
            <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <!-- ID del curso -->
    <div>
        {!! Form::label('hotmart_id', 'ID del curso', ['class' => 'block font-semibold text-gray-700 mb-1']) !!}
        {!! Form::text('hotmart_id', null, [
            'class' => 'form-input block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500',
            'placeholder' => 'Ejemplo: 123456789',
            'aria-describedby' => 'hotmart-id-help',
            'required' => false
        ]) !!}
        <p id="hotmart-id-help" class="text-xs text-gray-500 mt-1">Este ID es único para cada curso en Hotmart.</p>

        @error('hotmart_id')
            <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    
</div>



