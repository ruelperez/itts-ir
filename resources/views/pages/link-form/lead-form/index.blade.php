@extends('components.layouts.main')

@section('content')
    @livewire('link-form.lead-form.'.$page,['page' => $page])
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
