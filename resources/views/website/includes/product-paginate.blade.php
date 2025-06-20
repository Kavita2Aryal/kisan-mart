@php
    $current_page   = $data->currentPage();
    $last_page      = $data->lastPage();
    $total_data     = $data->total();
@endphp

@if($last_page > 1)
    <ul class="uk-pagination uk-flex-center" uk-margin>
        <li class="{{ ($current_page == 1) ? ' uk-disabled' : '' }}">
            <a class="item-paginate" href="javascript:void(0);" data-value="{{ ($current_page-1) > 0 ? $current_page-1 : $current_page }}"><span uk-pagination-previous></span></a>
        </li>

        @if ($last_page <= 10)

            @for($i=1; $i<=$last_page; $i++)
            <li class="{{ $i == $current_page ? 'uk-active' : '' }}">
                <a class="item-paginate" href="javascript:void(0);" {{ ($current_page == $i) ? '' : "data-value=" .$i }}>{{ $i }}</a>
            </li>
            @endfor

        @elseif ($last_page > 10)

            @if ($current_page < 6)

                @for($i=1; $i<=6; $i++)
                <li class="{{ $i == $current_page ? 'uk-active' : '' }}">
                    <a class="item-paginate" href="javascript:void(0);" {{ ($current_page == $i) ? '' : "data-value=" .$i }}>{{ $i }}</a>
                </li>
                @endfor
                
                <li>
                    <a>...</a>
                </li>
                
                @for($i=($last_page-3); $i<=$last_page; $i++)
                <li>
                    <a class="item-paginate" href="javascript:void(0);" data-value="{{ $i }}">{{ $i }}</a>
                </li>
                @endfor

            @elseif ($current_page >= $last_page-5)

                @for($i=1; $i<=4; $i++)
                <li>
                    <a class="item-paginate" href="javascript:void(0);" data-value="{{ $i }}">{{ $i }}</a>
                </li>
                @endfor
                
                <li>
                    <a>...</a>
                </li>
                
                @for($i=($last_page-5); $i<=$last_page; $i++)
                <li class="{{ $i == $current_page ? 'uk-active' : '' }}">
                    <a class="item-paginate" href="javascript:void(0);" {{ ($current_page == $i) ? '' : "data-value=" .$i }}>{{ $i }}</a>
                </li>
                @endfor

            @else

                @for($i=1; $i<=2; $i++)
                <li class="">
                    <a class="item-paginate" href="javascript:void(0);" data-value="{{ $i }}">{{ $i }}</a>
                </li>
                @endfor
                
                <li class="">
                    <a>...</a>
                </li>
                
                @for($i=($current_page-2); $i<=($current_page+2); $i++)
                <li class=" {{ $i == $current_page ? 'uk-active' : '' }}">
                    <a class="item-paginate" href="javascript:void(0);" {{ ($current_page == $i) ? '' : "data-value=" .$i }}>{{ $i }}</a>
                </li>
                @endfor
                
                <li class="">
                    <a>...</a>
                </li>
                
                @for($i=($last_page-1); $i<=$last_page; $i++)
                <li class="">
                    <a class="item-paginate" href="javascript:void(0);" data-value="{{ $i }}">{{ $i }}</a>
                </li>
                @endfor

            @endif

        @endif

        <li class="{{ ($current_page == $last_page) ? ' uk-disabled' : '' }}">
            <a class="item-paginate" href="javascript:void(0);" data-value="{{ $current_page+1 }}"> <span uk-pagination-next></span></a>
        </li>
    </ul>
@endif
