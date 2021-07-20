@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'is-invalid text-sm text-red-600']) }}>{{ $message }}</p>
@enderror
