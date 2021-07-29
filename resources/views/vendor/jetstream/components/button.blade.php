<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-warning round py-1 px-3 my-2 transition  ']) }}>
    {{ $slot }}
</button>
