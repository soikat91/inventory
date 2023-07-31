@extends('layouts.sidenav-layout')

@section('content')
@include('components.Customer.customer-list')
@include('components.Customer.customer-delete')
@include('components.Customer.customer-create')
@include('components.Customer.customer-update')

@endsection