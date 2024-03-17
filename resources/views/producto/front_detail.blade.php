@extends('layouts.main')

@section('content')
    @livewire('productdetail', ['id' => $id])
@endsection
