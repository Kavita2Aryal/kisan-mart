@extends('layouts.app')
@section('title', 'Sort Quick Links')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>Sort Quick Links To Set Their Display Order
                            <a href="{{ route('quick.link.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="sortable custom-checkbox">
                        <div class="row sortable-column" data-url="{{ route('quick.link.manage.order') }}">
                            @forelse($links as $link)
                                <div class="col-md-6" id="quick-link-{{ $link->id }}">
                                    <div class="card m-b-10 bg-info-lighter">
                                        <div class="card-header">
                                            <div class="card-title full-width">
                                                <div>
                                                    <span class="sn-index"></span>.
                                                    <span class="m-l-5">{{ $link->title }}</span>
                                                    <span class="pull-right"><i class="pg-icon">stepper</i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5>No data to display</h5>
                            @endforelse
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/sort.min.js') }}" type="text/javascript"></script>
@endpush