@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<header class="page-head"><div><h1 class="page-title">Profile</h1><p class="page-intro">The user record stored in the application database.</p></div></header>
<section class="profile-card"><div class="profile-avatar">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($user->full_name, 0, 1)) }}</div><div class="profile-details"><span class="eyebrow">Task manager user</span><h2>{{ $user->full_name }}</h2><p>@ {{ $user->username }}</p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div></section>
@endsection
