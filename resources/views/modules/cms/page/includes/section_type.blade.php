@php $type_contents = $section->type_contents(); @endphp
@if($type_contents != null)
@foreach($type_contents as $config_id => $type_content)
    @if ($type_content['type_id'] > 0 && $type_content['type_id'] <= 100)
    @php $tc = 0; @endphp
    <div class="row parent-container">
        <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">{{ $type_content != null ? $type_content['title'] : '' }} Contents:</div>
                </div>
                <div class="card-body">
                    <div class="custom-checkbox">
                        <div class="row sortable sortable-type-content {{ indexing() }}" id="{{ indexing() }}">
                            @if($type_content != null && $type_content['selected'] != null)
                                @foreach($type_content['selected'] as $item)
                                @php 
                                $indexing = indexing(); 
                                @endphp
                                <?php $tc++; ?>
                                <div class="col-md-4 padding-fix" id="typecontent-{{ $indexing }}-{{ $item->id }}">
                                    <div class="card bg-contrast-lower" data-pages="portlet">
                                        <div class="card-header">
                                            <div class="card-title full-width">
                                                <div class="form-check info">
                                                    <input class="typecontent-checkbox" type="checkbox" name="section[{{ $index }}][type][{{ $config_id }}][{{ $tc }}][id]" value="{{ $item->id }}" id="myCheckbox-{{ $indexing }}-{{ $item->id }}" checked />
                                                    <label for="myCheckbox-{{ $indexing }}-{{ $item->id }}">
                                                        {{ Str::limit($item->main, 30) }}
                                                    </label>
                                                    <span class="pull-right"><i class="pg-icon">drag</i></span>
                                                </div>
                                                <input class="display-order-value" type="hidden" name="section[{{ $index }}][type][{{ $config_id }}][{{ $tc }}][order]" value="{{ $tc }}">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p>{!! isset($item->body) ? Str::limit(strip_tags($item->body), 150) : '' !!}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            @if($type_content != null && $type_content['all'] != null)
                                @foreach($type_content['all'] as $item)
                                @php 
                                $indexing = indexing(); 
                                @endphp
                                @php $tc++; @endphp
                                <div class="col-md-4 padding-fix" id="typecontent-{{ $indexing }}-{{ $item->id }}">
                                    <div class="card bg-contrast-lower m-b-15" data-pages="portlet">
                                        <div class="card-header">
                                            <div class="card-title full-width">
                                                <div class="form-check info">
                                                    <input class="typecontent-checkbox" type="checkbox" name="section[{{ $index }}][type][{{ $config_id }}][{{ $tc }}][id]" value="{{ $item->id }}" id="myCheckbox-{{ $indexing }}-{{ $item->id }}" />
                                                    <label for="myCheckbox-{{ $indexing }}-{{ $item->id }}">
                                                        {{ Str::limit($item->main, 30) }}
                                                    </label>
                                                    <span class="pull-right"><i class="pg-icon">drag</i></span>
                                                </div>
                                                <input class="display-order-value" type="hidden" name="section[{{ $index }}][type][{{ $config_id }}][{{ $tc }}][order]" value="0">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div style="height: 85px; overflow-y: hidden;">
                                                <div>{!! isset($item->body) ? Str::limit(strip_tags($item->body), 200) : '' !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif ($type_content['type_id'] == 101)
    <div class="row">
        <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">Preview of the Contact us form</div>
                </div>
                <div class="card-body">
                    <img src="{{ url('storage/cms/section_type/section_type_101.jpg') }}" class="full-width">
                </div>
            </div>
        </div>
    </div>
    @elseif ($type_content['type_id'] == 102)
    <div class="row">
        <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">Preview of the Newsletter Subscription form</div>
                </div>
                <div class="card-body">
                    <img src="{{ url('storage/cms/section_type/section_type_102.jpg') }}" class="full-width">
                </div>
            </div>
        </div>
    </div>
    @endif

@endforeach
@endif