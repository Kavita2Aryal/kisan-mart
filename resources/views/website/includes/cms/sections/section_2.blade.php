@if($content->is_active == 10)
<div class="uk-section-default uk-section uk-padding-remove-vertical">
    <div class="uk-container uk-container-xlarge">
        <div class="uk-margin-remove-top tm-grid-expand uk-child-width-1-1 uk-grid-margin uk-margin-remove-top" uk-grid>
            <div class="uk-grid-item-match">
                <div class="uk-tile-muted uk-tile uk-tile-small">
					@if($content->slider_contents->count() > 0 && $content->slider_contents[0]->slider_items != null && $content->slider_contents[0]->slider_items->items != null)
						<h3 class="uk-h2 uk-text-emphasis uk-text-center">{!! $content->title !!}</h3>
						<div class="uk-margin uk-text-center">
							
								<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="infinite: true; autoplay: true;">

									<ul class="uk-slider-items uk-child-width-1-3 uk-child-width-auto@s uk-grid uk-grid-small uk-grid-match uk-flex-center">
										@foreach($content->slider_contents[0]->slider_items->items as $row)
											@isset($row->image->image)
												<li>
													<div class="uk-panel" style="background: #fff;">
														<a href="{{ $row->link }}">
															<img
																src="{{ secure_img($row->image->image, 'main') }}"
																width="110"
																height="110"
																class="el-image uk-border-rounded uk-box-shadow-small lozad"
																alt
																style="height: 110px; object-fit: contain;"
															/>
														</a>
													</div>
												</li>
											@endisset
										@endforeach
									</ul>

									<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
									<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

								</div>
							<!-- </div> -->
						</div>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif