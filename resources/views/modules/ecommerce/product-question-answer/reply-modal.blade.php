<div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 800px; margin: 0 auto;">
    <div class="modal-content">
        <div class="modal-header clearfix m-b-10">
            <button type="button" class="close text-danger" data-status="" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title full-width">Product Q&A 
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group required form-group-default @error('question') has-error @enderror">
                        <label>Question</label>
                        <div class="controls">
                            <textarea class="form-control @error('question') error @enderror" readonly name="question" required style="height:70px; color:black;">{{ $data->question }}</textarea>
                            @error('question')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="editor-description parent-section m-b-10 @error('answer') has-error @enderror" data-index="{{ $indexing }}">
                        <textarea class="editor-container editor-container-{{ $indexing }} @error('answer') error @enderror answer" name="answer">{{ $data->answer }}</textarea>
                        @error('answer')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                            <a class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-submit-reply" data-uuid="{{ $data->uuid }}">
                                SUBMIT <span class="visible-x-inline m-l-5">ANSWER</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">

<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script>summernote_init_simple();</script>