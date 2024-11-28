<!-- Campo: Título del curso -->
<div>
    {!! Form::label('title', 'Título del curso', ['class' => 'font-semibold text-gray-700']) !!}
    {!! Form::text('title', null, [
        'class' => 'form-input rounded-md block w-full mt-1 ' . ($errors->has('title') ? 'border-red-600' : ''),
        'id' => 'title'
    ]) !!}

    @error('title')
        <strong class="text-xs text-red-600">{{ $message }}</strong>
    @enderror
</div>

<!-- Campo: Slug del curso (solo lectura) -->
<div>
    {!! Form::label('slug', 'Slug del curso', ['class' => 'font-semibold text-gray-700']) !!}
    {!! Form::text('slug', null, [
        'class' => 'form-input rounded-md block w-full mt-1 ' . ($errors->has('slug') ? 'border-red-600' : ''),
        'id' => 'slug', 
        'readonly' => true
    ]) !!}

    @error('slug')
        <strong class="text-xs text-red-600">{{ $message }}</strong>
    @enderror
</div>

<!-- Campo: Subtítulo del curso -->
<div>
    {!! Form::label('subtitle', 'Subtítulo del curso', ['class' => 'font-semibold text-gray-700']) !!}
    {!! Form::text('subtitle', null, [
        'class' => 'form-input rounded-md block w-full mt-1 ' . ($errors->has('subtitle') ? 'border-red-600' : '')
    ]) !!}

    @error('subtitle')
        <strong class="text-xs text-red-600">{{ $message }}</strong>
    @enderror
</div>

<!-- Campo: Descripción del curso -->
<div>
    {!! Form::label('description', 'Descripción del curso', ['class' => 'font-semibold text-gray-700']) !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-input rounded-md block w-full mt-1 ' . ($errors->has('description') ? 'border-red-600' : ''), 
        'id' => 'editor'
    ]) !!}

    @error('description')
        <strong class="text-xs text-red-600">{{ $message }}</strong>
    @enderror
</div>

<!-- Selección de categoría, nivel y precio -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        {!! Form::label('category_id', 'Categoría:', ['class' => 'font-semibold text-gray-700']) !!}
        {!! Form::select('category_id', $categories, null, [
            'class' => 'form-input rounded-md block w-full mt-1 ' . ($errors->has('category_id') ? 'border-red-600' : '')
        ]) !!}
        
        @error('category_id')
            <strong class="text-xs text-red-600">{{ $message }}</strong>
        @enderror
    </div>
    <div>
        {!! Form::label('level_id', 'Nivel:', ['class' => 'font-semibold text-gray-700']) !!}
        {!! Form::select('level_id', $levels, null, [
            'class' => 'form-input rounded-md block w-full mt-1 ' . ($errors->has('level_id') ? 'border-red-600' : '')
        ]) !!}
        
        @error('level_id')
            <strong class="text-xs text-red-600">{{ $message }}</strong>
        @enderror
    </div>
    <div>
        {!! Form::label('price_id', 'Precio:', ['class' => 'font-semibold text-gray-700']) !!}
        {!! Form::select('price_id', $prices, null, [
            'class' => 'form-input rounded-md block w-full mt-1 ' . ($errors->has('price_id') ? 'border-red-600' : '')
        ]) !!}
        
        @error('price_id')
            <strong class="text-xs text-red-600">{{ $message }}</strong>
        @enderror
    </div>
</div>

<!-- Imagen del curso -->
<div>
    <h2 class="font-semibold text-gray-700 ">Imagen del curso</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <figure>
            @isset($course->image)
                <img id="picture" class="w-full h-64 object-cover object-center rounded-md mt-1 " src="{{ asset('storage/' . $course->image->url) }}" alt="Imagen del curso">
            @else
                <img id="picture" class="w-full h-64 object-cover object-center rounded-md mt-1 " src="{{ asset('img/default/img_default.jpg') }}" alt="Imagen del curso">
            @endisset
        </figure>
        <div>
            <p class="mb-2 text-sm text-gray-600">Sube una nueva imagen para tu curso.</p>
            {!! Form::file('file', [
                'class' => 'form-input rounded-md w-full' . ($errors->has('file') ? ' border-red-600' : ''),
                'id' => 'file',
                'accept' => 'image/*'
            ]) !!}
            
            @error('file')
                <strong class="text-xs text-red-600">{{ $message }}</strong>
            @enderror
        </div>
    </div>
</div>

