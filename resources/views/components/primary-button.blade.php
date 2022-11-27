<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary', 'style' => 'margin-top:1%; margin-bottom:1%;']) }}>
    {{ $slot }}
</button>
