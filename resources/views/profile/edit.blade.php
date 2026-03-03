@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <h1 class="text-2xl font-bold text-neutral-900 dark:text-white">Profile</h1>

    {{-- Update Profile Info --}}
    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6">
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Update Password --}}
    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6">
        @include('profile.partials.update-password-form')
    </div>

    {{-- Two Factor Authentication --}}
    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6">
        @include('profile.partials.two-factor-auth-form')
    </div>

    {{-- Delete Account --}}
    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-5 sm:p-6">
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
