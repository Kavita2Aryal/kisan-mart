<div class="card" style="position: relative;">
    <div class="card-body scroll-ing" id="send-section">
        <a href="javascript:void(0);" class="btn btn-link btn-link-fix btn-lg btn-filter-section">
            <i class="pg-icon">settings</i>
        </a>
        <div class="section-container">
            @if ($headers != null)
            @foreach ($headers as $hkey => $header)
            <div class="header-item content-item" style="display: none;">
                <div>
                    <img src="{{ url('storage/cms/header/'.$header) }}" class="full-width" data-tippy-content="Header {{ $hkey }}" data-tippy-placement="top-end">
                </div>
                <div class="content-tools">
                    <input type="hidden" name="header" value="{{ $hkey }}">
                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                </div>
            </div>
            @endforeach
            @endif

            @if ($footers != null)
            @foreach ($footers as $fkey => $footer)
            <div class="footer-item content-item" style="display: none;">
                <div>
                    <img src="{{ url('storage/cms/footer/'.$footer) }}" class="full-width" data-tippy-content="Footer {{ $fkey }}" data-tippy-placement="top-end">
                </div>
                <div class="content-tools">
                    <input type="hidden" name="footer" value="{{ $fkey }}">
                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                </div>
            </div>
            @endforeach
            @endif

            @if ($sections != null)
            @foreach ($sections as $section)

            @php 
            $filter_options = array_filter($section['config'], function ($conf) { return $conf == 1; }); 
            $filter_class = 'has-'.join(' has-', array_keys($filter_options)); 
            @endphp
            <div class="section-item section-item-{{ $section['index'] }} content-item {{ $filter_class }}">
                <div>
                    <img src="{{ secure_img_section($section['filename'], '768') }}" class="full-width" data-tippy-content="Section {{ $section['index'] }}" data-tippy-placement="top-end">
                </div>
                <div class="content-tools">
                    <input type="hidden" class="section-index" name="sections[not_set][index]" value="{{ $section['index'] }}">
                    <input type="hidden" class="section-order" name="sections[not_set][display_order]" value="">
                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    
    <div id="filter-section" class="scroll-ing" style="display: none;">
        <div class="row">
            <div class="col-sm-12">
                <p class="m-b-15">
                    <strong>SHOW ALL</strong>
                    <a href="javascript:void(0);" class="normal btn btn-link btn-filter-section-close pull-right" style="display: none;">
                        <i class="pg-icon">close_lg</i>
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-all-item" id="filter-all-header" value="header">
                        <label for="filter-all-header"><strong>HEADERS</strong></label>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-all-item" id="filter-all-footer" value="footer">
                        <label for="filter-all-footer"><strong>FOOTERS</strong></label>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-all-item" id="filter-all-section" value="section" checked>
                        <label for="filter-all-section"><strong>SECTIONS</strong></label>
                    </div>
                </a>
            </div>
        </div>
        <hr class="m-t-20 m-b-20">
        <div class="row">
            <div class="col-sm-12">
                <p class="m-b-15"><strong>MUST HAVE</strong></p>
            </div>
        </div>
        <div class="row">
            @if ($filters != null)
            @foreach($filters as $filter_key => $filter_text)
            <div class="col-sm-6">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-item" id="filter-{{ substr($filter_key, 5) }}" value="{{ $filter_key }}" checked>
                        <label for="filter-{{ substr($filter_key, 5) }}"><strong class="text-uppercase">{{ $filter_text }}</strong></label>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
        @if ($layouts)
        <hr class="m-t-20 m-b-20">
        <div class="row">
            <div class="col-sm-12">
                <p class="m-b-15"><strong>SAVED LAYOUT</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @foreach ($layouts as $layout)
                <div class="m-b-10 use-page-layout-parent">
                    <a href="javascript:void(0);" class="text-capitalize btn-use-page-lagout">{{ $layout['name'] }}</a>
                    <input type="hidden" class="use-page-layout" value="{{ $layout['sections'] }}">
                    <form action="{{ route('page.layout.config.destroy', [$layout['uuid']]) }}" method="POST" class="inline pull-right"> 
                        @method('DELETE') @csrf
                        <button class="btn btn-xs btn-ignore-loading" type="submit">
                            <i class="pg-icon">trash_alt</i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>