@extends('layouts.app')
@section('title', 'About')
@section('content')
<header class="page-head"><div><h1 class="page-title">About this project</h1><p class="page-intro">A simple task-management system built for the Laravel TSA3 assessment.</p></div></header>
<section class="content-panel"><h2>Developer</h2><p><strong>Francesca Marie Bustamante</strong></p><p>This application uses Laravel migrations, Eloquent models, controllers, and Blade views to organize and display task records.</p></section>
<section class="card-grid info-grid"><article class="card"><span class="card-icon">01</span><h3>Welcome</h3><p>Filters the task records to show only the current date.</p></article><article class="card"><span class="card-icon">02</span><h3>Task List</h3><p>Shows every task, grouped and ordered by scheduled date.</p></article><article class="card"><span class="card-icon">03</span><h3>Profile</h3><p>Displays the single seeded user profile.</p></article></section>
@endsection
