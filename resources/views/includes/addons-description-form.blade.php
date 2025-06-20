@php $indexing = indexing(); @endphp
<div class="editor-description parent-section content-content m-t-10 @error('contents.{{ $indexing }}.description') has-error @enderror" data-index="{{ $indexing }}">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
		    <button class="btn btn-link text-danger btn-lg btn-remove editor-remove"><i class="pg-icon">close_lg</i></button>
		    <textarea class="editor-container editor-container-{{ $indexing }} @error('contents.{{ $indexing }}.description') error @enderror" name="contents[{{ $indexing }}][description]">{{ $content->description ?? "" }}</textarea>
		    <input type="hidden" name="contents[{{ $indexing }}][display_order]" value="{{ $index }}">
			@error('contents.{{ $indexing }}.description')
			<label class="error">{{ $message }}</label>
			@enderror
		</div>
	</div>
</div>