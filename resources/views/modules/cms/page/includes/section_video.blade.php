<div class="card m-b-10">
    <div class="card-header">
        <div class="card-title">Section Video(s)</div>
        <div class="card-controls">
            <ul>
                <li>
                    <a href="#" class="btn-collapse" data-target=".section-video-parent-{{ $index }}"><i class="pg-icon">chevron_up</i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body section-video-parent section-video-parent-{{ $index }}">
        <div class="card bg-contrast-low m-b-0">
            <div class="card-body" style="padding: 10px 10px 0 10px;">
                @php $k=0; @endphp
                @forelse($section->list_videos as $row)
                    @php 
                    $indexing = indexing(); $k++;
                    if (isset($row->video_thumbnail_id) && $row->video_thumbnail_id > 0) {
                        $img_min = secure_img($row->thumbnail->image, '480X320');
                        $img_max = secure_img($row->thumbnail->image, '1200');
                    }
                    else {
                        $img_min = '';
                        $img_max = '';
                    }
                    @endphp
                    <div class="section-video">
                        <div class="card m-b-10">
                            <div class="card-body">
                                <div class="form-group form-group-default @error('section.'.$index.'.video.'.$k.'.title') has-error @enderror">
                                    <label>Video Title</label>
                                    <div class="controls">
                                        <input type="text" name="section[{{ $index }}][video][{{ $k }}][title]" class="form-control @error('section.'.$index.'.video.'.$k.'.title') error @enderror" autocomplete="off" required value="{{ $row->title }}">
                                        @error('section.'.$index.'.video.'.$k.'.title')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group form-group-default @error('section.'.$index.'.video.'.$k.'.value') has-error @enderror">
                                    <label>Video Link</label>
                                    <div class="controls">
                                        <input type="url" name="section[{{ $index }}][video][{{ $k }}][value]" class="form-control @error('section.'.$index.'.video.'.$k.'.value') error @enderror" autocomplete="off" required value="{{ $row->value }}">
                                        @error('section.'.$index.'.video.'.$k.'.value')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg m-b-10 open-use-media" data-type-media="single" data-populate-value=".populate-value-{{ $indexing }}" data-populate-media=".populate-container-{{ $indexing }}" id="{{ $indexing }}"><i class="pg-icon m-r-5">image</i> Browse Thumbnail</button>
                                    <input type="hidden" name="section[{{ $index }}][video][{{ $k }}][thumbnail]" class="populate-value-{{ $indexing }}" value="0">
                                    <div class="populate-container populate-container-{{ $indexing }}">
                                        <div class="populate-media">
                                            <a href="{{ $img_max }}" target="_blank">
                                                <img src="{{ $img_max }}" class="full-width">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @for($k=1; $k<=$count; $k++)
                    <div class="section-video">
                        <div class="card m-b-10">
                            <div class="card-body">
                                <div class="form-group form-group-default @error('section.'.$index.'.video.'.$k.'.title') has-error @enderror">
                                    <label>Video Title</label>
                                    <div class="controls">
                                        <input type="text" name="section[{{ $index }}][video][{{ $k }}][title]" class="form-control @error('section.'.$index.'.video.'.$k.'.title') error @enderror" autocomplete="off" required>
                                        @error('section.'.$index.'.video.'.$k.'.title')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group form-group-default @error('section.'.$index.'.video.'.$k.'.value') has-error @enderror">
                                    <label>Video Link</label>
                                    <div class="controls">
                                        <input type="url" name="section[{{ $index }}][video][{{ $k }}][value]" class="form-control @error('section.'.$index.'.video.'.$k.'.value') error @enderror" autocomplete="off" required>
                                        @error('section.'.$index.'.video.'.$k.'.value')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    @php $indexing = indexing(); @endphp
                                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg m-b-10 open-use-media" data-type-media="single" data-populate-value=".populate-value-{{ $indexing }}" data-populate-media=".populate-container-{{ $indexing }}" id="{{ $indexing }}"><i class="pg-icon m-r-5">image</i> Browse Thumbnail</button>
                                    <input type="hidden" name="section[{{ $index }}][video][{{ $k }}][thumbnail]" class="populate-value-{{ $indexing }}" value="0">
                                    <div class="populate-container populate-container-{{ $indexing }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</div>