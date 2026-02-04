<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="header">
    <div>
        <h5 class="mb-0">@yield('judulheader')</h5>
        <p class="font-header-p">@yield('keteranganheader')</p>
    </div>

   <div class="profile">
    <span>Admin</span>
    <img src="{{ asset('images/ava.png') }}" class="rounded-circle avatar">
</div>

</div>
