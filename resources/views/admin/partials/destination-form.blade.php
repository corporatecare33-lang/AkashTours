<form action="{{ route('admin.content.destinations.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3 bg-blue-50 p-4 rounded-3xl">
    @csrf
    <input name="name" required placeholder="Name" class="rounded-2xl px-4 py-3 font-bold outline-none">
    <input name="subtitle" placeholder="Subtitle" class="rounded-2xl px-4 py-3 font-bold outline-none">
    <input name="image" required placeholder="Image URL" class="md:col-span-2 rounded-2xl px-4 py-3 font-bold outline-none">
    <select name="layout" class="rounded-2xl px-4 py-3 font-bold outline-none">
        <option value="normal">Normal</option>
        <option value="wide">Wide</option>
        <option value="tall">Tall</option>
    </select>
    <input name="sort_order" type="number" value="10" class="rounded-2xl px-4 py-3 font-bold outline-none">
    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" checked> Active</label>
    <button class="bg-blue-600 text-white rounded-2xl px-4 py-3 font-black">Add Destination</button>
</form>

<div class="space-y-4">
    @foreach($destinations as $destination)
        <div class="border border-gray-100 rounded-3xl p-4">
            <form action="{{ route('admin.content.destinations.update', $destination) }}" method="POST" class="grid grid-cols-1 md:grid-cols-[140px_1fr] gap-4">
                @csrf
                <img src="{{ $destination->image }}" class="w-full h-36 object-cover rounded-2xl" alt="{{ $destination->name }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input name="name" value="{{ $destination->name }}" required class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="subtitle" value="{{ $destination->subtitle }}" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                    <input name="image" value="{{ $destination->image }}" required class="md:col-span-2 bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                    <select name="layout" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                        @foreach(['normal', 'wide', 'tall'] as $layout)
                            <option value="{{ $layout }}" @selected($destination->layout === $layout)>{{ ucfirst($layout) }}</option>
                        @endforeach
                    </select>
                    <input name="sort_order" type="number" value="{{ $destination->sort_order }}" class="bg-gray-50 rounded-2xl px-4 py-3 font-bold outline-none">
                    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_active" value="1" @checked($destination->is_active)> Active</label>
                    <button class="bg-slate-950 text-white rounded-2xl px-4 py-3 font-black">Save</button>
                </div>
            </form>
            <form action="{{ route('admin.content.destinations.delete', $destination) }}" method="POST" class="mt-3 text-right">
                @csrf
                @method('DELETE')
                <button class="text-red-500 font-black text-sm">Delete</button>
            </form>
        </div>
    @endforeach
</div>
