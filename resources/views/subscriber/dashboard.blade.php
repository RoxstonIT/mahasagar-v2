@extends('subscriber.layout')

@section('title', 'Subscriber Dashboard')

@section('content')
<div class="space-y-8">
    <div class="border-t-4 border-[#ec1e20] bg-white p-8 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-widest text-[#ec1e20] mb-3">
            Account Overview
        </p>

        <h1 class="text-3xl font-bold tracking-tight mb-4">
            Welcome, {{ auth()->user()->name }}
        </h1>

        <p class="text-neutral-700 leading-relaxed">
            Manage your saved stories, liked articles, and comments from one reader account area.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white border border-neutral-200 p-6">
            <p class="text-sm text-neutral-500 mb-2">Saved Articles</p>
            <p class="text-4xl font-bold">{{ $stats['saved_articles'] }}</p>
        </div>

        <div class="bg-white border border-neutral-200 p-6">
            <p class="text-sm text-neutral-500 mb-2">Liked Articles</p>
            <p class="text-4xl font-bold">{{ $stats['liked_articles'] }}</p>
        </div>

        <div class="bg-white border border-neutral-200 p-6">
            <p class="text-sm text-neutral-500 mb-2">Comments</p>
            <p class="text-4xl font-bold">{{ $stats['comments'] }}</p>
        </div>
    </div>

    <div class="bg-white border border-neutral-200 p-6">
        <h2 class="text-2xl font-bold tracking-tight mb-4">Recent Activity</h2>
        <p class="text-sm text-neutral-600">
            Recent activity will appear here once you save articles, like stories, or comment.
        </p>
    </div>
</div>
@endsection
