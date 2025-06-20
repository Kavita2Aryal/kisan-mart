<div class="card m-b-10">
    <div class="card-header">
        <div class="card-title">Section Slider(s)</div>
        <div class="card-controls">
            <ul>
                <li>
                    <a href="#" class="btn-collapse" data-target=".section-slider-parent-{{ $index }}"><i class="pg-icon">chevron_up</i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body section-slider-parent section-slider-parent-{{ $index }}">
        <div class="card bg-contrast-low m-b-0">
            <div class="card-body" style="padding: 10px 10px 0 10px;">
                @php $k=0;@endphp
                @forelse($section->slider_contents as $row)
                    @php $k++; @endphp
                    <div class="section-slider">
                        <div class="card m-b-10">
                            <div class="card-body">
                               <div class="form-group m-b-0 form-group-default-select2 @error('section.'.$index.'.slider.'.$k) has-error @enderror">
                                    <div class="controls">
                                        <select name="section[{{ $index }}][slider][{{ $k }}]" data-init-plugin="select2" class="select-slider full-width form-control @error('section.'.$index.'.slider.'.$k) error @enderror" required>
                                            <option value="" selected>Select a slider</option>
                                            @forelse ($sliders as $slider)
                                                <option value="{{ $slider->id }}" @if($slider->id == $row->slider_id) selected @endif>{{ $slider->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('section.'.$index.'.slider.'.$k)
                                            <label class="error m-t-10 m-b-0">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @for($k=1; $k<=$count; $k++)
                    <div class="section-slider">
                        <div class="card m-b-10">
                            <div class="card-body">
                               <div class="form-group m-b-0 form-group-default-select2 @error('section.'.$index.'.slider.'.$k) has-error @enderror">
                                    <div class="controls">
                                        <select name="section[{{ $index }}][slider][{{ $k }}]" data-init-plugin="select2" class="select-slider full-width form-control @error('section.'.$index.'.slider.'.$k) error @enderror" required>
                                            <option value="" selected>Select a slider</option>
                                            @forelse ($sliders as $slider)
                                                <option value="{{ $slider->id }}">{{ $slider->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('section.'.$index.'.slider.'.$k)
                                            <label class="error m-t-10 m-b-0">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                @endforelse
            </div>
        </div>
        <div class="section-slider-info">
            <p class="m-b-0 m-t-10"><small><span class="text-danger">*</span> You can create sliders from <a href="{{ route('slider.index') }}" class="text-danger" target="_blank"><strong>SLIDER MANAGER</strong></a> or click here to <a href="javascript:void(0);" class="refresh-slider text-danger" data-url="{{ route('slider.get') }}"><strong>REFRESH</strong></a> the List</small></p>
        </div>
    </div>
</div>