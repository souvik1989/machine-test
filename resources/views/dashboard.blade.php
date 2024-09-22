<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>

        <!-- Updated container for widgets -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 mb-4"> <!-- Adjusted to take half width -->
                    <div class="card gradient-primary o-hidden">
                        <div class="b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="file-text"></i></div>
                                <div class="media-body">
                                    <span class="m-0 text-white">Tasks Completed</span>
                                    <h4 class="mb-0 counter text-white text-bold">{{\App\Models\Task::where('status',1)->count()}}</h4>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 mb-4"> <!-- Adjusted to take half width -->
                    <div class="card gradient-secondary o-hidden">
                        <div class="b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="printer"></i></div>
                                <div class="media-body">
                                    <span class="m-0 text-white">Task Overdue</span>
                                    <h4 class="mb-0 counter text-white text-bold">{{\App\Models\Task::where('status',0)->count()}}</h4>
                                    <i class="icon-bg" data-feather="printer"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
