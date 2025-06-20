@extends('layouts.app')
@section('title', 'Update List Group')

@section('content')
<div class="container-fluid list-group-management">
    <form role="form" class="m-t-20" method="POST" action="{{ route('list.group.update', [$list_group->uuid]) }}" data-generate="{{ route('list.group.generate.form') }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            UPDATE LIST GROUP
                            <a href="{{ route('list.group.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>List Group Name</label>
                            <input type="text" class="form-control @error('name') error @enderror" name="name" required autocomplete="off" value="{{ $list_group->name ?? old('name') }}">
                            @error('name')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group required form-group-default @error('slug') has-error @enderror">
                            <label>List Group Slug</label>
                            <input type="text" class="form-control @error('slug') error @enderror" name="slug" required readonly autocomplete="off" value="{{ $list_group->slug ?? old('slug') }}">
                            @error('slug')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>

                        <div style="display: none;">
                        @if ($list_types != null)
                            <p><strong>List Type <span class="text-danger">*</span></strong></p>
                            @foreach ($list_types as $key => $type)
                            @if ($key == $list_group->list_type)  
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-check danger m-b-5 btn btn-link p-l-10 p-r-10">
                                        <input type="radio" name="list_type" value="{{ $key }}" id="checkbox-{{ $key }}" checked>
                                        <label for="checkbox-{{ $key }}">{{ $type }}</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>

                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">LIST GROUP</span>
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
                    <div class="card-body list-group-container" style="min-height: 172px;">
                    @if ($list_items != null)
                        @foreach ($list_items as $item)
                        @if ($list_group->list_type == 'title_value')

                            @include('modules.build.list-group.includes.title-value', ['item' => $item])

                        @else

                            @include('modules.build.list-group.includes.only-value', ['item' => $item])

                        @endif
                        @endforeach
                    @endif
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