@extends('layouts.app')
@section('title', 'Create Blog Category')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('blog.category.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Blog Category 
                            <a href="{{ route('blog.category.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>Category Name</label>
                            <div class="controls">
                                <input class="form-control @error('name') error @enderror" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-b-10">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active-1" checked>
                                    <label for="checkbox-active-1">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    CREATE <span class="visible-x-inline m-l-5">BLOG CATEGORY</span>
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