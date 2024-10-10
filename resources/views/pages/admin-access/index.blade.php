@extends('components.layouts.main')

@section('content')
    @livewire('admin-access.'.$page,['page' => $page])
@endsection
{{--@push('js')--}}
{{--    <script>--}}
{{--        $wire.on('subSubmitted', () => {--}}
{{--            $('#addClose').click();--}}
{{--            $('#btn123').click();--}}
{{--        });--}}
{{--        $wire.on('remOrUp', () => {--}}
{{--            $('#resClose').click();--}}
{{--            $('#btn456').click();--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
