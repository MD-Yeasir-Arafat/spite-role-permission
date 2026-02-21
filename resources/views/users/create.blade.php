<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Create') }}
            </h2>
        <a class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3" href="{{route('user.index')}}">Back</a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="mb-3">
                                <input type="text" value="{{ old('name')}}" placeholder="Enter Name" id="name" name="name"
                                    class="border border-gray-300 w-1/2 rounded-lg" />
                                    @error('name')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>

                            <label for="email" class="text-lg font-medium">Email</label>
                            <div class="mb-3">
                                <input type="email" value="{{ old('email')}}" placeholder="Enter Email" id="email" name="email"
                                    class="border border-gray-300 w-1/2 rounded-lg" />
                                    @error('email')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>

                             <label for="password" class="text-lg font-medium">Password</label>
                            <div class="mb-3">
                                <input type="password" placeholder="Enter Password" id="password" name="password"
                                    class="border border-gray-300 w-1/2 rounded-lg" />
                                    @error('password')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>

                            <label for="password_confirmation" class="text-lg font-medium">Confirm Password</label>
                            <div class="mb-3">
                                <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation"
                                    class="border border-gray-300 w-1/2 rounded-lg" />
                                    @error('password_confirmation')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>


                            <div class="grid grid-cols-4 mb-3">
                                @if($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <div class="mt-3">
                                            <input type="checkbox" class="rounded" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->name }}" >
                                            <label for="role-{{ $role->id }}" class="ml-2">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <button class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
