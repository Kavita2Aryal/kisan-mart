@extends('layouts.app')

@section('title', 'Create Policy')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('policy.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Policy
                            <a href="{{ route('policy.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('title') has-error @enderror">
                            <label>Title</label>
                            <div class="controls">
                                <input name="title" type="text" class="form-control @error('title') error @enderror" autocomplete="off" value="{{ old('title') }}">
                                @error('title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        @php $indexing = indexing(); @endphp
                        <div class="form-group editor-description @error('description') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('description') error @enderror" name="description">{{ old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $errors->first('description') }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group form-group-default input-group @error('effective_date') has-error @enderror required">
                                    <div class="form-input-group">
                                        <label>Effective Date</label>
                                        <input type="text" class="form-control effective-date @error('effective_date') error @enderror" name="effective_date" placeholder="Pick a date" autocomplete="off" value="{{ old('effective_date') }}" data-provide="datepicker-inline">
                                        @error('effective_date')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" checked>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    CREATE <span class="visible-x-inline m-l-5">POLICY</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script>
    summernote_init();
    var fromInput = $('.effective-date');
    var from = fromInput.val();
    fromInput.datepicker({
        format: 'yyyy-mm-dd',
        default: true,
        autoclose: true,
        widgetPositioning: {
            horizontal: "bottom",
            vertical: "auto"
        }
    });
</script>
@endpush