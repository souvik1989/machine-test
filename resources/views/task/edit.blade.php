

<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">Edit Task</h1>

        <form action="{{ route('tasks.update',$task->id) }}" method="POST" class="bg-white p-6 border border-gray-200 rounded-lg">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title',$task->title) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  rows="4" name="description" id="description" required>{{old('description',$task->description)}}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="task_category_id" class="block text-sm font-medium text-gray-700">Task Category</label>
                <select  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  name="task_category_id">
                     <option value="" Disabled selected> Please Select Option </option>
                     @if ($categories->count() > 0)
                     @foreach ($categories as $cat)
                     @if (!empty($task->task_category_id) && $task->task_category_id== $cat->id || collect(old('task_category_id'))->contains($cat->id))
                     <option value="{{ $cat->id }}" selected=""> {{ $cat->name }} </option>
                     @else
                     <option value="{{ $cat->id }}"> {{ $cat->name }} </option>
                     @endif
                     @endforeach
                     @endif
                 </select>
                @error('task_category_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
    <input type="date" id="due_date" name="due_date" value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
    @error('due_date')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

            <div class="mb-4">
                <label for="priority" class="block text-sm font-medium text-gray-700">Priority Level</label>
                <select id="priority" name="priority" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="0" {{ old('priority', $task->priority) == '0' ? 'selected' : '' }}>Low</option>
                    <option value="1" {{ old('priority', $task->priority) == '1' ? 'selected' : '' }}>Medium</option>
                    <option value="2" {{ old('priority', $task->priority) == '2' ? 'selected' : '' }}>High</option>
                </select>
                @error('priority')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="0" {{ old('status', $task->status) == '0' ? 'selected' : '' }}>Overdue</option>
                    <option value="1" {{ old('status', $task->status) == '1' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="ml-4 text-gray-600">Back to list</a>
        </form>
    </div>
</x-app-layout>
