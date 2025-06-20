<div id="popup" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
		<div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle uk-visible@s" uk-grid>
            <div class="uk-background-cover" style="background-image: url('{{ url('storage/website/lady-baby.jpg') }}');" uk-height-viewport></div>
            <div class="uk-padding-large ">
                <div class="uk-width-2xlarge uk-margin-auto">
                  
                <h1 class="uk-heading-small"> A unique window of opportunity to build a healthier life </h1>
                      <img src="{{ url('storage/website/logo.svg') }}" style="width:220px">
                </div>
            </div>
        </div>
		<div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle uk-hidden@s" uk-grid>
			<div class="uk-background-cover" style="background-image: url('{{ url('storage/website/mb2.jpg') }}'); background-position: center bottom" uk-height-viewport></div>
		</div>
    </div>
</div>

<script type="text/javascript">
    var modal = UIkit.modal("#popup");
    modal.show(); 
    setTimeout(function() {
        var modal = UIkit.modal("#popup");
            modal.hide();
    }, 3000);
</script>