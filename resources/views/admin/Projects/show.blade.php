@extends('layouts.app')

@section('content')
<h1>{{$project->title}}</h1>
<p>{{$project->description}}</p>

<a href="{{ route('admin.projects.index') }}"><button>torna all'elenco</button></a>
@endsection