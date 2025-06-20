@if($content->is_active == 10)
<div class="uk-section-default uk-section uk-section-large" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-fade; delay: false;">
    <div class="uk-container">
        <div class="tm-grid-expand uk-grid-column-large uk-grid-margin" uk-grid>
            <div class="uk-width-3-5@m">
                <h1 class="uk-heading-medium uk-font-secondary uk-margin-large uk-width-2xlarge uk-text-left" uk-scrollspy-class>{!! $content->title !!}</h1>
                <div class="uk-panel uk-margin-remove-first-child uk-margin" id="page#1-0-0-1" uk-scrollspy-class>
                    <h3 class="el-title uk-h2 uk-margin-top uk-margin-remove-bottom">{!! $content->subtitle !!}</h3>

                    <div class="el-content uk-panel uk-margin-medium-top">
                        <form method="post" action="{{ route('contact.store') }}">
                            @csrf
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                            <fieldset class="uk-fieldset">
                                <div class="uk-margin {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                    <input class="uk-input" type="text" placeholder="Full Name" name="name" value="{{ old('name') }}"/>
                                    @if($errors->has('name'))
                                    <span class="error-msg">
                                        <strong class="uk-text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="uk-margin {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                    <input class="uk-input" type="email" placeholder="Email Address" name="email" value="{{ old('email') }}"/>
                                    @if($errors->has('email'))
                                    <span class="error-msg">
                                        <strong class="uk-text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="uk-margin {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                    <input class="uk-input" type="text" placeholder="Phone Number" name="phone" value="{{ old('phone') }}"/>
                                    @if($errors->has('phone'))
                                    <span class="error-msg">
                                        <strong class="uk-text-danger">{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="uk-margin {{ $errors->has('message') ? 'is-invalid' : '' }}">
                                    <textarea class="uk-textarea" rows="5" name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                                    @if($errors->has('message'))
                                    <span class="error-msg">
                                        <strong class="uk-text-danger">{{ $errors->first('message') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @if(config('services.recaptcha.key_v2'))
                                    <div class="uk-margin" {{ $errors->has('g-recaptcha-response') ? 'is-invalid' : '' }}">
                                        <div class="g-recaptcha" data-type="image" data-sitekey="{{config('services.recaptcha.key_v2')}}"></div>
                                        @if($errors->has('g-recaptcha-response'))
                                            <span class="error-msg">
                                                <strong class="uk-text-danger">{{$errors->first('g-recaptcha-response')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <div class="uk-margin">
                                    <button class="uk-button uk-button-secondary uk-button-large" type="submit">SUBMIT</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

            <div class="uk-width-2-5@m">
                <div class="uk-panel uk-margin-remove-first-child uk-margin" uk-scrollspy-class>
                    <div class="uk-child-width-expand" uk-grid>
                        <div class="uk-width-auto@m"><span class="el-image" uk-icon="icon: whatsapp; width: 50; height: 50;"></span></div>
                        <div class="uk-margin-remove-first-child">
                            <h3 class="el-title uk-margin-top uk-margin-remove-bottom">
                                Call or chat with us <br />
                                on WhatsApp
                            </h3>

                            <div class="el-content uk-panel uk-margin-top">
                                @foreach($content->descriptions as $description)
                                    {!! $description->description !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-panel uk-margin-remove-first-child uk-margin" uk-scrollspy-class>
                    <div class="uk-child-width-expand" uk-grid>
                        <div class="uk-width-auto@m"><span class="el-image" uk-icon="icon: mail; width: 50; height: 50;"></span></div>
                        <div class="uk-margin-remove-first-child">
                            <h3 class="el-title uk-margin-top uk-margin-remove-bottom">Write to us</h3>

                            <div class="el-content uk-panel uk-text-lead">
                                <a class="el-content" href="mailto:{!! $settings['contact-email'] !!}">
                                    {!! $settings['contact-email'] !!}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif