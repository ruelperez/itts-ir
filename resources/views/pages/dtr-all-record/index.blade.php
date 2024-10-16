@extends('components.layouts.main')

@section('content')
    @livewire('dtr-all-record.'.$page,['page' => $page])
@endsection
