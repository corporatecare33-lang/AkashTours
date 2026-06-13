<form action="{{ route('admin.content.payments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3 bg-blue-50 p-4 rounded-3xl">
    @csrf
    <input name="name" required placeholder="Name" class="rounded-2xl px-4 py-3 font-bold outline-none">
    <input name="sort_order" type="number" value="20" class="rounded-2xl px-4 py-3 font-bold outline-none">
    <input name="logo" required placeholder="Logo URL" class="md:col-span-2 rounded-2xl px-4 py-3 font-bold outline-none">
    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" checked> Active</label>
    <button class="bg-blue-600 text-white rounded-2xl px-4 py-3 font-black">Add Payment</button>
</form>

<div class="space-y-4">
    @foreach($paymentMethods as $method)
        <div class="border border-gray-100 rounded-3xl p-4">
            <form action="{{ route('admin.content.payments.update', $method) }}" method="POST" class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4">
                @csrf
                <div class="bg-gray-50 rounded-2xl p-4 flex items-center justify-center">
                    <img src="{{ $method->logo }}" class="max-h-16 max-w-full" alt="{{ $method->name }}">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input name="name" value="{{ $method->name }}" required class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="sort_order" type="number" value="{{ $method->sort_order }}" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="logo" value="{{ $method->logo }}" required class="md:col-span-2 bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" @checked($method->is_active)> Active</label>
                    <button class="bg-slate-950 text-white rounded-2xl px-4 py-3 font-black">Save</button>
                </div>
            </form>
            <form action="{{ route('admin.content.payments.delete', $method) }}" method="POST" class="mt-3 text-right">
                @csrf
                @method('DELETE')
                <button class="text-red-500 font-black text-sm">Delete</button>
            </form>
        </div>
    @endforeach
</div>
