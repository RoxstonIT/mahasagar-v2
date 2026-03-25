@extends('layouts.admin.app')

@section('content')
    <div class="p-6 max-w-xl">

        <x-admin.page-header 
            title="Edit Category"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Categories', 'url' => route('admin.categories.index')],
                ['label' => 'Edit']
            ]"
        />

        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            @include('admin.categories._form', [
                'category' => $category,
                'buttonText' => 'Update'
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