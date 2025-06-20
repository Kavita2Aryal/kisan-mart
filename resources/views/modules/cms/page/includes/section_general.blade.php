@if ($config->has_title == 1)
<div class="section-title">
    <div class="form-group form-group-default @error('section.'.$index.'.title') has-error @enderror">
        <label>Title</label>
        <input type="text" name="section[{{ $index }}][title]" class="form-control @error('section.'.$index.'.title') error @enderror" autocomplete="off" required value="{{ $section->title }}">
        @error('section.'.$index.'.title')
            <label class="error">{{ $message }}</label>
        @enderror
    </div>
</div>
@endif
@if ($config->has_subtitle == 1)
<div class="section-subtitle">
    <div class="form-group form-group-default @error('section.'.$index.'.subtitle') has-error @enderror">
        <label>Subtitle</label>
        <textarea name="section[{{ $index }}][subtitle]" class="form-control @error('section.'.$index.'.subtitle') error @enderror" required style="height: 60px;">{{ $section->subtitle }}</textarea>
        @error('section.'.$index.'.subtitle')
            <label class="error">{{ $message }}</label>
        @enderror
    </div>
</div>
@endif
<div class="section-publish">
    <div class="form-check info m-b-0">
        <input type="checkbox" name="section[{{ $index }}][is_active]" value="10" id="checkbox-{{ $index }}" @if($section->is_active == 10) checked @endif>
        <label for="checkbox-{{ $index }}">Publish ?</label>
    </div>
</div>