<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-xs uppercase tracking-widest active:bg-gray-900 focus:outline-none bg-indigo-500 text-white hover:bg-indigo-600 focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition  ']) }}>
    {{ $slot }}
</button>
