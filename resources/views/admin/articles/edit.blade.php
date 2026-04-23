@extends('layouts.admin.app')

@section('content')

<x-admin.page-header title="Edit Article" />

<div class="px-10">
    <div class="bg-white p-6 rounded shadow">

        @include('admin.articles._form')

    </div>
</div>

@endsection