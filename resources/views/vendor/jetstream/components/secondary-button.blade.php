<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-warning round py-1 my-2 transition']) }}>
    {{ $slot }}
</button>
