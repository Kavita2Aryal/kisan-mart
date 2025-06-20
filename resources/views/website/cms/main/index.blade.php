@extends('layout.app')

@section('title')
{{ $page->name }}
@endsection

@push('seo')
@include('includes.seo.seo',
[
'seo' => $page->seo,
'url' => url()->current()
]
)
@endpush

@section('frontend-content')
<!-- working body container -->

<!-- Headers shall be included over here for other projects -->
@if($page->header_id > 0)
@include('includes.cms.headers.header_' . $page->header_id)
@endif


@if($required_contents != null)
@foreach($required_contents as $content_alt => $section_name)
{!! ${$content_alt} !!}
@endforeach
@endif


<!-- Footers shall be included over here for other projects -->
@if($page->footer_id > 0)
@include('includes.cms.footers.footer_' . $page->footer_id)
@endif

<!-- working body container -->
@endsection

<!-- Popups shall be included over here for other projects -->
@push('popups')
@if ($page->popups->count() > 0)
@include('includes.cms.popups.popup')
@endif
@endpush

@push('styles')
@if(isset($required_plugins['styles']))
@foreach($all_styles as $key => $path_to_style)
@if (in_array($key, $required_plugins['styles']))
<link rel="stylesheet" type="text/css" href="{{ $path_to_style }}">
@endif
@endforeach
@endif
@endpush

@push('scripts')
@if(isset($required_plugins['scripts']))
@foreach($all_scripts as $key => $path_to_script)
@if (in_array($key, $required_plugins['scripts']))
<script type="text/javascript" src="{{ $path_to_script }}"></script>
@endif
@endforeach
@endif
@endpush