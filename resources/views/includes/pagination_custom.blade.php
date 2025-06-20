<div class="row m-t-30 m-b-30">
	<div class="col-sm-12">
		<div class="scroll-pagination scroll-ing">
			<ul class="pagination" id="pagination">
			    @if ($paging->total_pages <= 10)

			        @for($i=1; $i<=$paging->total_pages; $i++)
			        <li class="page-item {{ $i == $paging->page ? 'active' : '' }}">
			            <a {{ ($paging->page == $i) ? '' : "href=" . $paging->url . ($i) }} class="page-link">{{ $i }}</a>
			        </li>
			        @endfor

			    @elseif ($paging->total_pages > 10)

			        @if ($paging->page < 6)

			            @for($i=1; $i<=6; $i++)
			            <li class="page-item {{ $i == $paging->page ? 'active' : '' }}">
				            <a {{ ($paging->page == $i) ? '' : "href=" . $paging->url . ($i) }} class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			           
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			           
			            @for($i=($paging->total_pages-3); $i<=$paging->total_pages; $i++)
			            <li class="page-item">
				            <a href="{{ $paging->url . ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor

			        @elseif ($paging->page >= $paging->total_pages-5)

			            @for($i=1; $i<=4; $i++)
			            <li class="page-item">
				            <a href="{{ $paging->url . ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			            
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			            
			            @for($i=($paging->total_pages-5); $i<=$paging->total_pages; $i++)
			            <li class="page-item {{ $i == $paging->page ? 'active' : '' }}">
				            <a {{ ($paging->page == $i) ? '' : "href=" . $paging->url . ($i) }} class="page-link">{{ $i }}</a>
				        </li>
			            @endfor

			        @else

			            @for($i=1; $i<=2; $i++)
			            <li class="page-item">
				            <a href="{{ $paging->url . ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			            
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			            
			            @for($i=($paging->page-2); $i<=($paging->page+2); $i++)
			            <li class="page-item {{ $i == $current_page ? 'active' : '' }}">
				            <a {{ ($paging->page == $i) ? '' : "href=" . $paging->url . ($i) }} class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			            
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			            
			            @for($i=($paging->total_pages-1); $i<=$paging->total_pages; $i++)
			            <li class="page-item">
				            <a href="{{ $paging->url . ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor

			        @endif

			    @endif
		    </ul>
		</div>
	</div>
</div>