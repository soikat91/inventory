@extends('layouts.sidenav-layout')

@section('content')
@include('components.Product.product-list')
@include('components.Product.product-delete')
@include('components.Product.product-create')
@include('components.Product.product-update')
@endsection