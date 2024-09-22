<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white">Tasks</h1>

            <!-- Search Form -->
            <form method="GET" action="{{ route('tasks.index') }}" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                @if(request('search'))
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Clear Search</a>
                @endif
            </form>

            <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Task</a>
        </div>

        <div class="mb-4">
            <form method="GET" action="{{ route('tasks.index') }}" class="flex space-x-2">
                <button type="submit" name="priority" value="0" class="bg-yellow-500 text-white px-4 py-2 rounded">Low</button>
                <button type="submit" name="priority" value="1" class="bg-blue-500 text-white px-4 py-2 rounded">Medium</button>
                <button type="submit" name="priority" value="2" class="bg-green-500 text-white px-4 py-2 rounded">High</button>
                @if (request()->has('priority'))
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Clear Filter</a>
                @endif

            </form>
        </div>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="w-full bg-gray-100 border-b border-gray-200">
                    <th class="py-2 px-4 text-left">Title</th>
                    <th class="py-2 px-4 text-left">Category</th>
                    <th class="py-2 px-4 text-left">Due Date</th>
                    <th class="py-2 px-4 text-left">Priority</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($tasks->isEmpty())
                <tr>
                    <td colspan="6" class="py-2 px-4 text-center">No tasks found</td>
                </tr>
                @else
                @foreach ($tasks as $task)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $task->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $task->task_category->name }}</td>
                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</td>
                    <td class="py-2 px-4 border-b">@if($task->priority==0) Low @elseif($task->priority==1) Medium @else High @endif</td>
                    <td class="py-2 px-4 border-b">@if($task->status==0) Overdue @else Completed @endif</td>
                    <td class="py-2 px-4 border-b flex space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="text-green-500">Edit</a>
                        <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="{{ $task->status }}">
                            @if ($task->status == '0')
                            <button type="submit" class="text-green-500">Completed</button>
                            @else
                            <button type="submit" class="text-red-500">Overdue</button>
                            @endif
                        </form>
                        <form action="{{ route('tasks.priority', $task->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="@if ($task->priority == '0') text-yellow-500 @elseif ($task->priority == '1') text-blue-500 @else text-green-500 @endif">
                                @if ($task->priority == '0') Low @elseif ($task->priority == '1') Medium @else High @endif
                            </button>
                        </form>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>

           

            <!-- Clear Filter Button -->
            @if (request('search'))
            <div class="mt-4">
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Clear Search</a>
            </div>
            @endif


        </table>
        <!-- Pagination Controls -->
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>