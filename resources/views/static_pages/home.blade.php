@extends('layouts.default')
@section('title','主页')
@section('content')
<div class="jumbotron">
	<h1>laravel</h1>
	<p class="lead">
		您现在所看到的是<a href="https://laravel-china.org/laravel-tutorial/5.1">laravel 入门教程</a>de 
	</p>
	<p>
		一切，从这里开始
	</p>
	<p  >
		<a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
	</p>
</div>
@stop