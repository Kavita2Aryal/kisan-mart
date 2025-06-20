@if(Auth::check() && Auth::user()->has_agreed != 10)
    @if(!session()->has('policy-popup'))
        {{ session()->put('policy-popup', 'yes') }}
        <div id="policy-modal" class="uk-flex-top" uk-modal="bg-close:false">
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <h2 class="uk-modal-title">Changes in Terms and Conditions</h2>
                <p>We have revised our terms and conditions. You need to agree to the revised terms and condition in order to proceed forward.</p>
                <label> <input class="uk-checkbox new-policy-agreed" name="has_agreed" required type="checkbox"/> I accept the <a href="{{ route('terms.and.conditions') }}" target="_blank">terms of service</a>.
            </div>
        </div>
        <script>
            $(function() {
                UIkit.modal('#policy-modal').show();
            });
            $(document).on('change', '.new-policy-agreed', function(e) {
                e.preventDefault();
                if($(this).is(':checked')){
                    setTimeout(function() {
                        $.ajax({
                            url: "{{ route('policy.agreed') }}",
                            type: "post",
                            async: false,
                            success: function (response) {
                                if (response.status) {
                                    UIkit.modal('#policy-modal').hide();
                                    UIkit.notification({
                                        message: "You have accepted the terms of service",
                                        status: "success",
                                        pos: "top-right",
                                        timeout: 1000,
                                    });
                                }
                            }
                        })
                    }, 500)
                }
            });
        </script>
    @endif
@endif