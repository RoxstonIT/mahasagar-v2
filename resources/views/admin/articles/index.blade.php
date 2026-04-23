@extends('layouts.admin.app')

@section('content')
    <div class="p-6">

        <x-admin.page-header 
            title="Articles"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Articles']
            ]"
        >
            <x-slot name="action">
                @if(auth()->user()->hasPermission('submit_news_article'))
                    <a href="{{ route('admin.articles.create') }}"
                       class="bg-[#ec1e20] text-white px-4 py-2 rounded-lg hover:opacity-90">
                        + Add Article
                    </a>
                @endif
            </x-slot>
        </x-admin.page-header>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <form method="GET" action="{{ route('admin.articles.index') }}" class="m-4 flex gap-2">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search articles..."
                    class="border rounded-lg px-3 py-2 w-64 focus:ring-2 focus:ring-[#ec1e20]">

                <button type="submit"
                        class="bg-[#ec1e20] text-white px-4 py-2 rounded-lg">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.articles.index') }}"
                    class="px-4 py-2 border rounded-lg">
                        Reset
                    </a>
                @endif

            </form>

            <x-admin.table :headers="[
                    ['label' => 'ID', 'key' => 'id', 'sortable' => true],
                    ['label' => 'Title', 'key' => 'title', 'sortable' => true],
                    ['label' => 'Category', 'key' => 'category_id', 'sortable' => false],
                    ['label' => 'Status', 'key' => 'status', 'sortable' => true],
                    ['label' => 'Created At', 'key' => 'created_at', 'sortable' => true],
                    ['label' => 'Actions', 'key' => 'actions', 'sortable' => false]
                ]" :sort="request('sort')" :direction="request('direction')">

                @forelse($articles as $article)
                    <tr class="border-t">
                        <td class="p-4">{{ $article->id }}</td>
                        <td class="p-4 font-medium">{{ $article->title }}</td>
                        <td class="p-4 text-gray-500">
                            {{ $article->category->name ?? '-' }}
                        </td>
                        <td class="p-4">
                            {{ ucfirst($article->status) }}
                        </td>
                        <td class="p-4 text-gray-500">
                            {{ $article->created_at->format('M d, Y H:i A') }}
                        </td>
                        <td class="p-4 flex gap-3">

                            @if(auth()->user()->hasPermission('edit_news_article_before_approval'))
                                <a href="{{ route('admin.articles.edit', $article->id) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>
                            @endif

                            @if(auth()->user()->hasPermission('delete_news_article_before_approval'))
                                <form action="{{ route('admin.articles.destroy', $article->id) }}"
                                      method="POST"
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="text-red-600 hover:underline delete-btn">
                                        Delete
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6">

                            <x-admin.empty-state
                                title="No articles found"
                                description="Start by creating your first article"
                            >
                                <x-slot name="action">
                                    @if(auth()->user()->hasPermission('submit_news_article'))
                                        <a href="{{ route('admin.articles.create') }}"
                                           class="bg-[#ec1e20] text-white px-4 py-2 rounded-lg">
                                            + Create Article
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
            {{ $articles->links() }}
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
                    text: "This will delete the article.",
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