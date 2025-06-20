<div class="uk-section-secondary uk-section uk-section-xsmall">
    <div class="uk-container uk-container-large">
        <div class="tm-grid-expand uk-grid-margin" uk-grid>
            <div class="uk-grid-item-match uk-flex-middle uk-width-1-3@m">
                <div class="uk-panel uk-width-1-1">
                    <div class="uk-text-left">
                        <a class="el-link" href="{{ route('home') }}" uk-scroll><img src="{{ url('storage/website/logo-inverse.svg') }}" width="180" class="el-image" alt /></a>
                    </div>
                </div>
            </div>

            <div class="uk-grid-item-match uk-flex-middle uk-width-1-2@s uk-width-1-3@m">
                <div class="uk-panel uk-width-1-1">
                    <div class="uk-panel uk-margin-remove-first-child uk-margin">
                        <div class="uk-child-width-expand uk-grid-column-small" uk-grid>
                            <div class="uk-width-auto"><span class="el-image" uk-icon="icon: receiver; width: 50; height: 50;"></span></div>
                            <a href="tel:{{ $settings['contact-phone'] }}">
                                <div class="uk-margin-remove-first-child">
                                    <div class="el-meta uk-h5 uk-margin-remove-bottom uk-margin-remove-top">Call Us</div>
                                    <h3 class="el-title uk-h3 uk-margin-remove-top uk-margin-remove-bottom">{{ $settings['contact-phone'] }}</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid-item-match uk-flex-middle uk-width-1-2@s uk-width-1-3@m">
                <div class="uk-panel uk-width-1-1">
                    <div class="uk-panel uk-margin-remove-first-child uk-margin">
                        <div class="uk-child-width-expand uk-grid-column-small" uk-grid>
                            <div class="uk-width-auto"><span class="el-image" uk-icon="icon: mail; width: 50; height: 50;"></span></div>
                            <a href="mailto:{{ $settings['contact-email'] }}">
                                <div class="uk-margin-remove-first-child">
                                    <div class="el-meta uk-h5 uk-margin-remove-bottom uk-margin-remove-top">Email</div>
                                    <h3 class="el-title uk-h3 uk-margin-remove-top uk-margin-remove-bottom">
                                        {{ $settings['contact-email'] }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-position-relative">
    <div style="background-size: 1440px auto; background-image: url('{{ url('storage/website/babyfoot.svg') }}');" class="uk-background-norepeat uk-background-center-right uk-section">
        <div class="uk-position-cover" style="background-color: rgba(255, 255, 255, 0.75);"></div>

        <div class="uk-container uk-container-large uk-position-relative">
            <div class="tm-grid-expand uk-grid-large uk-grid-margin-large" uk-grid>
                @if(isset($quick_links) && $quick_links != null)
                    @foreach($quick_links as $key => $quick_link)
                        <div class="uk-width-1-2@s uk-width-1-4@m">
                            <h2 class="uk-h5">{!! $quick_link_groups[$key] !!}</h2>
                            <ul class="uk-list">
                                @foreach($quick_link as $link)
                                    <li class="el-item">
                                        <div class="el-content uk-panel"><a href="{!! $link['link'] !!}" class="el-link uk-link-text uk-margin-remove-last-child">{!! $link['title'] !!}</a></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif
                @if(isset($social_medias) && $social_medias != null)
                    <div class="uk-width-1-2@s uk-width-1-4@m">
                        <h2 class="uk-h5">Social Media</h2>
                        <ul class="uk-list">
                            @foreach($social_medias as $social_media)
                                <li class="el-item">
                                    <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-middle" uk-grid>
                                        <div class="uk-width-auto">
                                            <a href="{!! $social_media['link'] !!}"><span class="el-image" uk-icon="icon: {!! $social_media['social'] !!};"></span></a>
                                        </div>
                                        <div>
                                            <div class="el-content uk-panel"><a href="{!! $social_media['link'] !!}" class="el-link uk-link-text uk-margin-remove-last-child">{!! $social_media['social'] !!}</a></div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="tm-grid-expand uk-grid-row-small uk-margin-large" uk-grid>
                <div class="uk-grid-item-match uk-flex-middle uk-width-2-3 uk-width-2-5@m">
                    <div class="uk-panel uk-width-1-1">
                        <div class="uk-panel uk-text-meta uk-margin uk-text-left">
                            ©
                            {{ date('Y') }}
                            {{ $settings['contact-title'] }}. All rights reserved.<br class="uk-hidden@s" />
                            Website by <a class="uk-link-muted" href="https://curvesncolors.com/">Curves n Colors</a>.
                        </div>
                    </div>
                </div>
                
                <div class="uk-grid-item-match uk-flex-middle uk-width-expand uk-visible@m">
                    <div class="uk-panel uk-width-1-1">
                        <div class="uk-visible@m uk-margin">
                            <div class="uk-child-width-auto uk-flex-center uk-grid-small uk-grid-match" uk-grid>
                                <!-- <div>
                                    <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                        <img src="images/yootheme/footer-icon-visa.svg" width="35" class="el-image uk-text-muted" alt uk-svg />
                                    </div>
                                </div>
                                <div>
                                    <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                        <img src="images/yootheme/footer-icon-paypal.svg" width="35" class="el-image uk-text-muted" alt uk-svg />
                                    </div>
                                </div>
                                <div>
                                    <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                        <img src="images/yootheme/footer-icon-applepay.svg" width="35" class="el-image uk-text-muted" alt uk-svg />
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-grid-item-match uk-flex-middle uk-width-auto uk-width-2-5@m">
                    <div class="uk-panel uk-width-1-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>