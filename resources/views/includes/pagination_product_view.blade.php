<div class="row m-t-30 m-b-30">
	<div class="col-sm-12">
		<div class="scroll-pagination scroll-ing">
			<ul class="pagination" id="pagination">
			    @if ($total_pages <= 10)

			        @for($i=1; $i<=$total_pages; $i++)
			        <li class="page-item {{ $i == $page ? 'active' : '' }}">
			            <a {{ ($page == $i) ? '' : "href=" . $url . '&page='. ($i) }} class="page-link">{{ $i }}</a>
			        </li>
			        @endfor

			    @elseif ($total_pages > 10)

			        @if ($page < 6)

			            @for($i=1; $i<=6; $i++)
			            <li class="page-item {{ $i == $page ? 'active' : '' }}">
				            <a {{ ($page == $i) ? '' : "href=" . $url . '&page='. ($i) }} class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			           
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			           
			            @for($i=($total_pages-3); $i<=$total_pages; $i++)
			            <li class="page-item">
				            <a href="{{ $url . '&page='. ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor

			        @elseif ($page >= $total_pages-5)

			            @for($i=1; $i<=4; $i++)
			            <li class="page-item">
				            <a href="{{ $url . '&page='. ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			            
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			            
			            @for($i=($total_pages-5); $i<=$total_pages; $i++)
			            <li class="page-item {{ $i == $page ? 'active' : '' }}">
				            <a {{ ($page == $i) ? '' : "href=" . $url . '&page='. ($i) }} class="page-link">{{ $i }}</a>
				        </li>
			            @endfor

			        @else

			            @for($i=1; $i<=2; $i++)
			            <li class="page-item">
				            <a href="{{ $url . '&page='. ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			            
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			            
			            @for($i=($page-2); $i<=($page+2); $i++)
			            <li class="page-item {{ $i == $current_page ? 'active' : '' }}">
				            <a {{ ($page == $i) ? '' : "href=" . $url . '&page='. ($i) }} class="page-link">{{ $i }}</a>
				        </li>
			            @endfor
			            
			            <li class="page-item">
				            <a class="page-link">...</a>
				        </li>
			            
			            @for($i=($total_pages-1); $i<=$total_pages; $i++)
			            <li class="page-item">
				            <a href="{{ $url . '&page='. ($i) }}" class="page-link">{{ $i }}</a>
				        </li>
			            @endfor

			        @endif

			    @endif
		    </ul>
		</div>
	</div>
</div>