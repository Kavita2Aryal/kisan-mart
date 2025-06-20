@php $group=0; $list_contents = $section->list_contents(); @endphp
@forelse ($list_contents as $list_content)

    @php 
    $group++;
    $indexing = indexing(); 
    @endphp

    <div class="card m-b-10">
        <div class="card-header">
            <div class="card-title">Section List(s) - {{ $group }}</div>
            <div class="card-controls">
                <ul>
                    <li>
                        <a href="#" class="btn-collapse" data-target=".section-list-parent-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body section-list-parent section-list-parent-{{ $indexing }}">
            <div class="card bg-contrast-low m-b-0">
                <div class="card-body" style="padding: 10px 10px 0 10px;">

                    @includeWhen(
                        $list_content['list_config_head'], 
                        'modules.cms.page.includes.section_list_head', 
                        [
                            'list_content_head' => $list_content['list_content_head'], 
                            'list_config_head'  => $list_content['list_config_head'], 
                            'index' => $index, 
                            'group' => $group
                        ]
                    )

                    @includeWhen(
                        $list_content['list_config_body'], 
                        'modules.cms.page.includes.section_list_body', 
                        [
                            'list_content_body' => $list_content['list_content_body'], 
                            'list_config_body'  => $list_content['list_config_body'], 
                            'index' => $index, 
                            'group' => $group
                        ]
                    )
                    
                    <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][head_config]" value="{{ $list_content['list_config_head']->id ?? 0 }}">
                    <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][body_config]" value="{{ $list_content['list_config_body']->id }}">
                    
                </div>
            </div>
        </div>
    </div>

@empty

    @php $list_bodies = $config->list_config_body; @endphp

    @foreach ($list_bodies as $list_config_body)

    @php 
    $group++; 
    $indexing = indexing(); 
    $list_config_head = $list_config_body->list_config_head;
    @endphp

    <div class="card m-b-15">
        <div class="card-header">
            <div class="card-title">Section List(s) - {{ $group }}</div>
            <div class="card-controls">
                <ul>
                    <li>
                        <a href="#" class="btn-collapse" data-target=".section-list-parent-{{ $indexing }}"><i class="pg-icon">chevron_up</i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body section-list-parent section-list-parent-{{ $indexing }}">
            <div class="card bg-contrast-low m-b-0">
                <div class="card-body" style="padding: 10px 10px 0 10px;">

                    @includeWhen(
                        $list_config_head, 
                        'modules.page.includes.section_list_head', 
                        ['list_content_head' => '', 'list_config_head' => $list_config_head, 'index' => $index, 'group' => $group]
                    )

                    @includeWhen(
                        $list_config_body, 
                        'modules.page.includes.section_list_body', 
                        ['list_content_body' => '', 'list_config_body' => $list_config_body, 'index' => $index, 'group' => $group]
                    )
                    
                    <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][head_config]" value="{{ $list_config_head->id ?? 0 }}">
                    <input type="hidden" name="section[{{ $index }}][list][{{ $group }}][body_config]" value="{{ $list_config_body->id }}">
                    
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endforelse