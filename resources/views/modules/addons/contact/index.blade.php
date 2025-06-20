@extends('layouts.app')
@section('title', 'Contact Messages')

@section('content')
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Contact Messages ({{ $contacts->total() }})
                            <a style="display:none;" href="{{ route('contact.export.pdf') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <span class="visible-x-inline m-r-5">EXPORT</span> PDF
                            </a>
                            <a href="{{ route('contact.export.csv') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <span class="visible-x-inline m-r-5">EXPORT</span> CSV
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($contacts->count() > 0)
                            @php $i = ($contacts->currentPage() - 1) * $contacts->perPage(); @endphp
                            @foreach ($contacts as $contact)
                            @php $i++;
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->message }}</td>
                                <td>{{ $contact->created_at }}</td>
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
            @include('includes.pagination', ['page' => $contacts])
        </div>
    </div>
</div>
@endsection