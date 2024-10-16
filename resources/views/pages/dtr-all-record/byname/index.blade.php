@extends('components.layouts.main')

@section('content')
    @livewire('dtr-all-record.byname.'.$page,['page' => $page,'emp_id' => $emp_id])
@endsection
