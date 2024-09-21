

<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

        <form action="{{ route('category.update', $category) }}" method="POST" class="bg-white p-6 border border-gray-200 rounded-lg">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            
           
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Disable</option>
                    <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Enable</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Category</button>
            <a href="{{ route('category.index') }}" class="ml-4 text-gray-600">Back to list</a>
        </form>
    </div>
</x-app-layout>
