@extends('layouts.app')
@section('title', 'Web Alias')

@section('content')
@php $domain = get_setting('website-domain'); @endphp
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-lg-12">
            @include('includes.pagination_search')
            <div class="card">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>Web Alias ({{ $alias->total() }})</div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th width="50">Name</th>
                                <th width="50">URL / Alias</th>
                                <th width="50">Type</th>
                                <th width="50">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = ($alias->currentPage() - 1) * $alias->perPage(); @endphp
                            @if ($alias->count() > 0)
                            @foreach ($alias as $row)
                            <tr class="alias-item alias-item-{{ $row->id }}">
                                <input type="hidden" class="alias-index" value="{{ $row->id }}">
                                <input type="hidden" class="alias-value" value="{{ $row->alias }}">
                                @if ($row->page_id > 0 && $row->page != null)
                                @php $page = $row->page; @endphp

                                <input type="hidden" class="alias-parent" data-type="page" value="{{ $page->id }}">

                                @if ($page->is_home == 10)
                                <td>{{ ++$i }}</td>
                                <td>{{ $page->name }}</td>
                                <td>
                                    <a href="{{ $domain }}" target="_blank">
                                        {{ $domain }}
                                    </a>
                                </td>
                                <td><strong>PAGE</strong></td>
                                <td><strong class="text-success">PUBLISHED</strong></td>
                                @else
                                <td>{{ ++$i }}</td>
                                <td>{{ $page->name }}</td>
                                <td>
                                    <a href="{{ $domain.$row->alias }}" target="_blank">
                                        {{ $domain }}<span class="alias-display">{{ $row->alias }}</span>
                                    </a>
                                </td>
                                <td><strong>PAGE</strong></td>
                                <td class="alias-status">
                                    @if ($page->is_active == 10)
                                    <strong class="text-success">PUBLISHED</strong>
                                    @else
                                    <strong class="text-danger">UNPUBLISHED</strong>
                                    @endif
                                </td>
                                @endif

                                @elseif ($row->blog_id > 0 && $row->blog != null)
                                @php $blog = $row->blog; @endphp
                                <input type="hidden" class="alias-parent" data-type="blog" value="{{ $blog->id }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>
                                    <a href="{{ $domain.$row->alias }}" target="_blank">
                                        {{ $domain }}<span class="alias-display">{{ $row->alias }}</span>
                                    </a>
                                </td>
                                <td><strong>BLOG</strong></td>
                                <td class="alias-status">
                                    @if ($blog->is_active == 10)
                                    <strong class="text-success">PUBLISHED</strong>
                                    @else
                                    <strong class="text-danger">UNPUBLISHED</strong>
                                    @endif
                                </td>
                                @elseif ($row->event_id > 0 && $row->event != null)
                                @php $event = $row->event; @endphp
                                <input type="hidden" class="alias-parent" data-type="event" value="{{ $event->id }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $event->title }}</td>
                                <td>
                                    <a href="{{ $domain.$row->alias }}" target="_blank">
                                        {{ $domain }}<span class="alias-display">{{ $row->alias }}</span>
                                    </a>
                                </td>
                                <td><strong>EVENT</strong></td>
                                <td class="alias-status">
                                    @if ($event->is_active == 10)
                                    <strong class="text-success">PUBLISHED</strong>
                                    @else
                                    <strong class="text-danger">UNPUBLISHED</strong>
                                    @endif
                                </td>
                                @elseif ($row->news_id > 0 && $row->news != null)
                                @php $news = $row->news; @endphp
                                <input type="hidden" class="alias-parent" data-type="news" value="{{ $news->id }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $news->title }}</td>
                                <td>
                                    <a href="{{ $domain.$row->alias }}" target="_blank">
                                        {{ $domain }}<span class="alias-display">{{ $row->alias }}</span>
                                    </a>
                                </td>
                                <td><strong>NEWS</strong></td>
                                <td class="alias-status">
                                    @if ($news->is_active == 10)
                                    <strong class="text-success">PUBLISHED</strong>
                                    @else
                                    <strong class="text-danger">UNPUBLISHED</strong>
                                    @endif
                                </td>
                                @elseif ($row->package_id > 0 && $row->package != null)
                                @php $package = $row->package; @endphp
                                <input type="hidden" class="alias-parent" data-type="package" value="{{ $package->id }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $package->name }}</td>
                                <td>
                                    <a href="{{ $domain.$row->alias }}" target="_blank">
                                        {{ $domain }}<span class="alias-display">{{ $row->alias }}</span>
                                    </a>
                                </td>
                                <td><strong>PACKAGE</strong></td>
                                <td class="alias-status">
                                    @if ($package->is_active == 10)
                                    <strong class="text-success">PUBLISHED</strong>
                                    @else
                                    <strong class="text-danger">UNPUBLISHED</strong>
                                    @endif
                                </td>
                                @endif
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

            @include('includes.pagination', ['page' => $alias])

            <div class="card">
                <div class="card-header">
                    <div class="card-title full-width">
                        <h5 class="text-uppercase no-margin">Default Web Alias ({{ count($default_pages) }}) </h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="27">#</th>
                                <th width="50">Name</th>
                                <th width="50">Link</th>
                                <th width="50">Type</th>
                                <th width="50">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @if ($default_pages != null)
                            @foreach($default_pages as $key => $dpage)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $dpage }}</td>
                                <td>{{ ($key == '/') ? $domain : $domain . $key }}</td>
                                <td><strong>DEFAULT PAGE</strong></td>
                                <td><strong class="text-success">PUBLISH</strong></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection