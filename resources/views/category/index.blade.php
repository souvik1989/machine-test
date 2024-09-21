

<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Categories</h1>

            <!-- Search Form -->
            <form method="GET" action="{{ route('category.index') }}" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                @if(request('search'))
                    <a href="{{ route('category.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Clear Search</a>
                @endif
            </form>

            <a href="{{ route('category.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Category</a>
        </div>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="w-full bg-gray-100 border-b border-gray-200">
                    
                    <th class="py-2 px-4 text-left">Name</th>
                    
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                     
                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                       
                       
                        <td class="py-2 px-4 border-b">@if($category->status==0)Disable @else Enable  @endif
</td>
                        <td class="py-2 px-4 border-b flex space-x-2">
                            
                            <a href="{{ route('category.edit', $category) }}" class="text-green-500">Edit</a>
<!-- Status -->
                          
<form action="{{ route('category.status', $category->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $category->status }}">
                                    @if ($category->status == '0')
                                    <button type="submit" class="text-yellow-500">Enable</button>
                                    @else
                                    <button type="submit" class="text-green-500">Disable</button>
                                    @endif
                                </form>
                           
                            <!-- Delete Form -->
                            <form action="{{ route('category.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-center">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
