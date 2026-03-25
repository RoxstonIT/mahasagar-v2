@extends('layouts.admin.app')

@section('content')
    <div class="p-6 max-w-xl">

        <x-admin.page-header 
            title="Create Category"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Categories', 'url' => route('admin.categories.index')],
                ['label' => 'Create']
            ]"
        />

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf

            @include('admin.categories._form', [
                'buttonText' => 'Create'
            ])
        </form>

    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (!nameInput || !slugInput) return;

        nameInput.addEventListener('input', function () {
            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-');

            slugInput.value = '/'+slug;
        });

    });
</script>