@extends('layouts.app')
@section('title', 'Sliders')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Sliders ({{ $sliders->count() }})
                            <a href="{{ route('slider.create') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">SLIDER</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Slider Name</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Slider">
                            @if ($sliders->count() > 0)
                            @php $i = 0; @endphp
                            @foreach ($sliders as $slider)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $slider->name }}</td>
                                <td>{{ $slider->user->name }}</td>
                                <td>{{ $slider->updated_at }}</td>
                                <td>
                                    <a href="{{ route('slider.edit', [$slider->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    <a href="{{ route('slider.sort', [$slider->uuid]) }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-primary m-b-5">
                                        <i class="pg-icon m-r-5">stepper</i> SORT
                                    </a>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger btn-delete m-b-5" data-form="{{$i}}" type="button">
                                        <i class="pg-icon m-r-5">close_lg</i> DELETE
                                    </button>
                                    <form class="delete-form-{{$i}}" action="{{ route('slider.destroy', [$slider->uuid]) }}" method="POST" style="display: none;"> @method('DELETE') @csrf </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">No data to display</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @include('includes.pagination', ['page' => $sliders])
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/button.all.min.js') }}" type="text/javascript"></script>
@endpush