@extends('components.layouts.main')

@section('content')
    @livewire($page,['name' => $empID])
@endsection
