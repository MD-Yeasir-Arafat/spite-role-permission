<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Article Edit') }}
            </h2>
        <a class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3" href="{{route('article.index')}}">Back</a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('article.update', $article->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="title" class="text-lg font-medium">Title</label>
                            <div class="mb-3">
                                <input type="text" value="{{ old('title', $article->title ?? '')}}" placeholder="Enter Title" id="title" name="title"
                                    class="border border-gray-300 w-1/2 rounded-lg" />
                                    @error('title')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>

                            <label for="text" class="text-lg font-medium">Content</label>
                            <div class="mb-3">
                                <textarea placeholder="Content" name="text" id="text" placeholder="Enter Content" class="border border-gray-300 w-1/2 rounded-lg">{{ old('text', $article->text ?? '')}}</textarea>
                                    @error('text')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>

                            <label for="author" class="text-lg font-medium">Author</label>
                            <div class="mb-3">
                                <input type="text" value="{{ old('author', $article->author ?? '')}}" placeholder="Enter Author" id="author" name="author"
                                    class="border border-gray-300 w-1/2 rounded-lg" />
                                    @error('author')
                                            <p class="text-red-400 font-medium">{{$message}}</p>
                                    @enderror
                            </div>
                            <button class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
