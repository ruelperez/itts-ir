@extends('components.layouts.main')

@section('content')
    @livewire($page,['name' => $page, 'id' => $id])
@endsection
