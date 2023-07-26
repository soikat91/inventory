@extends('layouts.sidenav-layout')
@section('content')
@include('components.Category.category-list')
@include('components.Category.category-delete')
@include('components.Category.category-create')
@include('components.Category.category-update')

@endsection