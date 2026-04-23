@extends('layouts.admin.app')

@section('content')
    <div class="p-6">

        <x-admin.page-header 
            title="Categories"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Categories']
            ]"
        >
            <x-slot name="action">
                @if(auth()->user()->hasPermission('create_category'))
                    <a href="{{ route('admin.categories.create') }}"
                    class="bg-[#ec1e20] text-white px-4 py-2 rounded-lg hover:opacity-90">
                        + Add Category
                    </a>
                @endif
            </x-slot>
        </x-page-header>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="m-4 flex gap-2">
    
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search categories..."
                    class="border rounded-lg px-3 py-2 w-64 focus:ring-2 focus:ring-[#ec1e20]">

                <button type="submit"
                        class="bg-[#ec1e20] text-white px-4 py-2 rounded-lg">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 border rounded-lg">
                        Reset
                    </a>
                @endif

            </form>
            
            <x-admin.table :headers="[
                ['label' => 'ID', 'key' => 'id', 'sortable' => true],
                ['label' => 'Name', 'key' => 'name', 'sortable' => true],
                ['label' => 'Slug', 'key' => 'slug', 'sortable' => true],
                ['label' => 'Actions', 'key' => 'actions', 'sortable' => false]
            ]" :sort="request('sort')" :direction="request('direction')">

                @forelse($categories as $category)
                    <tr class="border-t">
                        <td class="p-4">{{ $category->id }}</td>
                        <td class="p-4 font-medium">{{ $category->name }}</td>
                        <td class="p-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="p-4 flex gap-3">

                            @if(auth()->user()->hasPermission('edit_category'))
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="text-blue-600 hover:underline">
                                    Edit
                                </a>
                            @endif

                            @if(auth()->user()->hasPermission('delete_category'))
                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                    method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="text-red-600 hover:underline delete-btn">
                                        Delete
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">

                            <x-admin.empty-state
                                title="No categories found"
                                description="Start by creating your first category"
                            >
                                <x-slot name="action">
                                    @if(auth()->user()->hasPermission('create_category'))
                                        <a href="{{ route('admin.categories.create') }}"
                                        class="bg-[#ec1e20] text-white px-4 py-2 rounded-lg">
                                            + Create Category
                                        </a>
                                    @endif
                                </x-slot>

                            </x-admin.empty-state>

                        </td>
                    </tr>
                @endforelse

            </x-admin.table>

        </div>
        
        <div class="m-4">
            {{ $categories->links() }}
        </div>

    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.delete-btn').forEach(button => {

            button.addEventListener('click', function () {

                let form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will delete the category.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ec1e20',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });

            });

        });

    });
</script>
@endsection