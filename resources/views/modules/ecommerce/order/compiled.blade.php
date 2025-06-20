@extends('layouts.app')

@section('title', 'Compiled Total Orders')

@section('content')
<div class="row">
    <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title full-width">Compiled Total Order: from all non shipped & delivered orders</div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive-block">
                    <thead>
                        <tr>
                            <th width="27">#</th>
                            <th width="50">Product</th>
                            <th width="50">Total Required</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data != null)
                        @php $i=0; @endphp
                        @foreach($data as $row)
                        @php $i++; @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{!! $row->name !!}</td>
                            <td>{{ $row->total_qty }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection