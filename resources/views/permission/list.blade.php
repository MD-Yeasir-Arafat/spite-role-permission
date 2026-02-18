<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <a class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3"
                href="{{ route('permission.create') }}">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-center" width="200">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($permissions->isNotEmpty())
                        @foreach ($permissions as $permission)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $permission->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $permission->name }}</td>
                                <td class="px-6 py-3 text-left">{{ Carbon\Carbon::parse($permission->created_at)->format('d M Y') }}</td>
                                <td class="px-6 py-3 text-center">

                                    <div class="flex items-center justify-center gap-2">
                                        <a class="bg-slate-700 text-sm rounded-lg text-white px-5 py-3 hover:bg-slate-600"
                                            href="{{ route('permission.edit', $permission->id) }}">Edit</a>

                                        <button type="submit"
                                            class="bg-red-700 text-sm rounded-lg text-white px-5 py-3 hover:bg-red-600"
                                            onclick="deletePermission({{ $permission->id }})">Delete</button>

                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="mt-3">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id) {

                if (!confirm('Are you sure you want to delete this permission?')) {
                    return;
                }

                $.ajax({
                    url: "{{ route('permission.destroy') }}",
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
                            alert("Failed to delete the permission.");
                        }

                    }
                });
            }
        </script>

    </x-slot>
</x-app-layout>
