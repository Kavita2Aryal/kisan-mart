@php $indexing = indexing(); @endphp
<form action="{{ route('section.config.update', [$section['uuid']]) }}" method="POST"> 
    @method('PUT') 
    @csrf     
    <div class="card section-{{ $indexing }}">
        <div class="card-header no-padding">
            <div class="card-title full-width" style="border-bottom: 1px solid #f4f4f4;">
                <img src="{{ url('storage/cms/section/'.$section['filename']) }}" class="full-width section-image">
                <input type="hidden" name="config[{{ $indexing }}][filename]" value="{{ $section['filename'] }}" class="section-filename">
            </div>
        </div>
        <div class="card-body p-b-10">
            <div class="form-horizontal">
                <div class="row m-t-10">
                    <strong class="col-md-12">
                        Section Configuration:
                        <button type="submit" class="btn btn-link btn-link-fix p-r-10 p-l-10 pull-right btn-update m-l-5" data-indexing="{{ $indexing }}">UPDATE</button>
                        <button type="button" class="btn btn-link text-danger pull-right btn-delete"  data-uuid="{{ $section['uuid'] }}">DELETE</button>
                    </strong>
                </div>
                @include('modules.build.section-config.update.general')
                @include('modules.build.section-config.update.list')
                @include('modules.build.section-config.update.type')
                @include('modules.build.section-config.update.cdn')
                @include('modules.build.section-config.update.screenshot')
            </div>
        </div>
    </div>
</form>
<form class="delete-form-{{ $section['uuid'] }}" action="{{ route('section.config.destroy', [$section['uuid']]) }}" method="POST" style="display: none;"> 
    @method('DELETE') @csrf 
</form>