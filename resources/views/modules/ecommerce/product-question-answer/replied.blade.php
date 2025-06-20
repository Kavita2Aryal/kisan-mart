@extends('layouts.app')
@section('title', 'Product Q&A')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card card-borderless">
                <div class="card-header">
                    <h5 class="no-margin">
                        Product Q&A ({{ $data->total() }})
                    </h5>
                </div>
                <ul class="nav nav-tabs nav-tabs-simple" role="tablist">
                    <li class="nav-item">
                        <a href="{{ route('product.question.answer.pending') }}">Pending Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="active" href="{{ route('product.question.answer.replied') }}">Replied Questions</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pendingQuestions">
                        <table class="table table-hover table-responsive-block">
                            <thead>
                                <tr>
                                    <th width="25">#</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Status</th>
                                    <th>Replied By</th>
                                    <th>Replied At</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody data-title="product question">
                                @if ($data->count() > 0)
                                @php $i = ($data->currentPage() - 1) * $data->perPage(); $url = config('app.config.website'); @endphp
                                @foreach ($data as $row)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row->customer->name }}</td>
                                    <td><a href="{{ $row->product->alias->alias }}">{{ ucwords($row->product->name) }}</a></td>
                                    <td>{{ $row->question }}</td>
                                    <td>{!! $row->answer !!}</td>
                                    <td class="change-status">
                                        @if ($row->is_active == 10)
                                        <strong class="text-success">PUBLISHED<strong>
                                                @else
                                                <strong class="text-danger">UNPUBLISHED<strong>
                                                        @endif
                                    </td>
                                    <td>{{ $row->user_id != null ? $row->user->name : 'N/A'}}</td>
                                    <td>{{ $row->replied_at }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5 btn-reply" data-uuid="{{ $row->uuid }}">
                                            <i class="pg-icon m-r-5">pencil</i> EDIT
                                        </a>
                                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete m-b-5 btn-change-status" data-url="{{ route('product.question.answer.change.status', [$row->uuid]) }}" type="button">
                                            <i class="pg-icon m-r-5">tick</i>
                                            <span>{{ $row->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH' }}</span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7">No data to display</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('includes.pagination', ['page' => $data])
        </div>
    </div>
</div>
<div class="modal fade modal-question-answer" data-backdrop="static">
</div>
@endsection

@include('modules.ecommerce.product-question-answer.asset')
