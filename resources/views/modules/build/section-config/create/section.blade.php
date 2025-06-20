@php $indexing = indexing(); @endphp
<div class="col-lg-4 parent-section">
    <div class="card section-{{ $indexing }}">
        <div class="card-header no-padding">
            <div class="card-title full-width">
                <img src="{{ url('storage/cms/section/'.$filename) }}" class="full-width section-image">
                <input type="hidden" name="config[{{ $indexing }}][filename]" value="{{ $filename }}" class="section-filename">
            </div>
        </div>
        <div class="card-body p-b-10">
            <div class="form-horizontal">
                <div class="row m-t-10">
                    <strong class="col-md-12">
                        Section Configuration:
                        <button type="button" class="btn btn-link text-danger pull-right btn-delete" data-uuid="0">DELETE</button>
                    </strong>
                </div>
                
                @include('modules.build.section-config.create.general')

                @include('modules.build.section-config.create.list')

                @include('modules.build.section-config.create.type')

                @include('modules.build.section-config.create.cdn')

            </div>
        </div>
    </div>
</div>