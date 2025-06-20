@extends('layouts.app')
@section('title', 'Create List Group')

@section('content')
<div class="container-fluid list-group-management">
    <form role="form" class="m-t-20" method="POST" action="{{ route('list.group.store') }}" data-generate="{{ route('list.group.generate.form') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            CREATE LIST GROUP
                            <a href="{{ route('list.group.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>List Group Name</label>
                            <input type="text" class="form-control @error('name') error @enderror" name="name" required autocomplete="off" value="{{ old('name') }}">
                            @error('name')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group required form-group-default @error('slug') has-error @enderror">
                            <label>List Group Slug</label>
                            <input type="text" class="form-control @error('slug') error @enderror" name="slug" required autocomplete="off" value="{{ old('slug') }}">
                            @error('slug')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>

                        @if ($list_types != null)
                        <p><strong>List Type <span class="text-danger">*</span></strong></p>
                        @foreach ($list_types as $key => $type)
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-check danger m-b-5 btn btn-link p-l-10 p-r-10">
                                    <input type="radio" name="list_type" value="{{ $key }}" id="checkbox-{{ $key }}" @if ($key == 'title_value') checked @endif>
                                    <label for="checkbox-{{ $key }}">{{ $type }}</label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    CREATE <span class="visible-x-inline m-l-5">LIST GROUP</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width"> LIST GROUP ITEMS
                            <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10 btn-add-item" type="button">
                                <i class="pg-icon m-r-5">plus</i>
                                <span class="visible-x-inline m-r-5">ADD</span> ITEM
                            </button>
                        </div>
                    </div>
                    <div class="card-body list-group-container" style="min-height: 280px;">
                        @error('items')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/list-group.min.js') }}" type="text/javascript"></script>
@endpush