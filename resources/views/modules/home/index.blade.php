@extends('components.templates.main-component')
@section('content')    
    <div>
        Olá {{ Auth::user()->name }}
    </div>
@endsection
