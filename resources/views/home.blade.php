@extends('layouts.app')

@section('titulo')
    Pagina Home
@endsection

@section('contenido')

    <x-listar-post :posts="$posts"/>

@endsection