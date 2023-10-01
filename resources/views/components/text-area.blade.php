@props([
    'nombreLabel' => 'label',
    'tipo' => 'text',
    'name' => '',
])

<div>
    <label for="{{ $name }}" class="mb-2 block uppercase text-gray-500 font-bold">{{ $nombreLabel }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}"
        class="border p-3 w-full rounded-lg @error($name) border-red-500 @enderror">{{ old($name) }}</textarea>
    @error($name)
        <p class="mt-2 rounded-lg bg-red-500 text-center text-white text-sm p-2">{{ $message }}</p>
    @enderror    
</div>
