@props([
    'label',
    'name',
    'value' => '',
    'required' => false,
])

<label class="space-y-2 block">
    <span class="text-xs font-black text-gray-400 uppercase">{{ $label }}</span>
    <input
        name="{{ $name }}"
        value="{{ $value }}"
        @if($required) required @endif
        class="w-full bg-gray-50 rounded-2xl px-5 py-4 font-bold outline-none focus:ring-2 focus:ring-blue-100"
    >
</label>
