@extends('layouts.admin.app')

@section('content')
    <div class="p-6">

        <x-admin.page-header 
            title="Comments"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Comments']
            ]"
        />

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <form method="GET" action="{{ route('admin.comments.index') }}" class="m-4 flex flex-col md:flex-row gap-2">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search comments..."
                    class="border rounded-lg px-3 py-2 w-full md:w-64 focus:ring-2 focus:ring-[#ec1e20]">

                <select name="status" class="border rounded-lg px-3 py-2 w-full md:w-48 focus:ring-2 focus:ring-[#ec1e20]">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>

                <button type="submit"
                        class="bg-[#ec1e20] text-white px-4 py-2 rounded-lg">
                    Filter
                </button>

                @if(request('search') || request('status'))
                    <a href="{{ route('admin.comments.index') }}"
                    class="px-4 py-2 border rounded-lg text-center">
                        Reset
                    </a>
                @endif

            </form>

            <x-admin.table :headers="[
                    ['label' => 'Subscriber', 'key' => 'subscriber', 'sortable' => false],
                    ['label' => 'Article', 'key' => 'article', 'sortable' => false],
                    ['label' => 'Comment', 'key' => 'body', 'sortable' => false],
                    ['label' => 'Status', 'key' => 'status', 'sortable' => false],
                    ['label' => 'Created At', 'key' => 'created_at', 'sortable' => false],
                    ['label' => 'Actions', 'key' => 'actions', 'sortable' => false]
                ]" :sort="request('sort')" :direction="request('direction')">

                @forelse($comments as $comment)
                    <tr class="border-t align-top">
                        <td class="p-4">
                            <p class="font-medium">{{ $comment->user->name ?? 'Deleted subscriber' }}</p>
                            <p class="text-sm text-gray-500">{{ $comment->user->email ?? '-' }}</p>
                        </td>

                        <td class="p-4">
                            @if($comment->article)
                                <p class="font-medium max-w-xs">
                                    {{ $comment->article->title }}
                                </p>

                                @if(!$comment->article->trashed() && $comment->article->status === 'approved')
                                    <a href="{{ route('news.show', $comment->article->slug) }}"
                                       target="_blank"
                                       class="text-sm text-blue-600 hover:underline">
                                        View Article
                                    </a>
                                @else
                                    <p class="text-sm text-gray-500">
                                        Article not public
                                    </p>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">Article unavailable</p>
                            @endif
                        </td>

                        <td class="p-4">
                            <p class="max-w-md text-sm text-gray-700 leading-relaxed">
                                {{ $comment->body }}
                            </p>
                        </td>

                        <td class="p-4">
                            <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                {{ $comment->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $comment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $comment->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($comment->status) }}
                            </span>
                        </td>

                        <td class="p-4 text-gray-500">
                            {{ $comment->created_at->format('M d, Y H:i A') }}
                        </td>

                        <td class="p-4">
                            <div class="flex flex-col gap-2">
                                @if($comment->status !== 'approved')
                                    <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="text-green-700 hover:underline">
                                            Approve
                                        </button>
                                    </form>
                                @endif

                                @if($comment->status !== 'rejected')
                                    <form action="{{ route('admin.comments.reject', $comment) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="text-yellow-700 hover:underline">
                                            Reject
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.comments.destroy', $comment) }}"
                                      method="POST"
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="text-red-600 hover:underline delete-btn">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6">
                            <x-admin.empty-state
                                title="No comments found"
                                description="Subscriber comments will appear here for moderation"
                            />
                        </td>
                    </tr>
                @endforelse

            </x-admin.table>

        </div>

        <div class="m-4">
            {{ $comments->links() }}
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
                    text: "This will delete the comment.",
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
