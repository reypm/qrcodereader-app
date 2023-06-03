<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-500 leading-tight">
            {{ __('Submissions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                    <form action="{{ route('submission.store') }}"
                                          method="POST"
                                          enctype="multipart/form-data"
                                          class="flex items-center space-x-6"
                                    >
                                        @csrf

                                        <div class="mb-3">
                                            <span class="sr-only" for="inputFile">Choose file</span>
                                            <input
                                                type="file"
                                                name="file"
                                                id="inputFile"
                                                class="form-control @error('file') is-invalid @enderror"
                                            >

                                            @error('file')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
