<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            <a class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3"
                href="{{ route('article.create') }}">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Content</th>
                        <th class="px-6 py-3 text-left">Author</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-center" width="200">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($articles->isNotEmpty())
                        @foreach ($articles as $article)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $article->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $article->title }}</td>
                                <td class="px-6 py-3 text-left">{{ $article->text }}</td>
                                <td class="px-6 py-3 text-left">{{ $article->author }}</td>
                                <td class="px-6 py-3 text-left">{{ Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</td>
                                <td class="px-6 py-3 text-center">

                                    <div class="flex items-center justify-center gap-2">
                                        <a class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3 hover:bg-slate-600"
                                            href="{{ route('article.edit', $article->id) }}">Edit</a>

                                        <button type="submit"
                                            class="bg-red-700 text-sm rounded-lg text-white px-5 py-3 hover:bg-red-600"
                                            onclick="deleteArticle({{ $article->id }})">Delete</button>

                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="mt-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deleteArticle(id) {

                if (!confirm('Are you sure you want to delete this article?')) {
                    return;
                }

                $.ajax({
                    url: "{{ route('article.destroy') }}",
                    type: "DELETE",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    headers: { // 👈 headers (not header)
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.status == true) {
                            location.reload();
                        } else {
                            alert("Failed to delete the article.");
                        }

                    }
                });
            }
        </script>

    </x-slot>
</x-app-layout>
