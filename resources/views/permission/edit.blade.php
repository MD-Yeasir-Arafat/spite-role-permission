<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permission Edit') }}
            </h2>
        <a class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3" href="{{route('permission.index')}}">Back</a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="mb-3">
                                <input type="text" value="{{ old('name', $permission->name)}}" placeholder="Enter Name" id="name" name="name"
                                    class="border border-gray-300 w-1/2 rounded-lg" />
                                    @error('name')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>
                            <button class="bg-slate-700 hover:bg-slate-600 text-sm rounded-lg text-white px-5 py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
