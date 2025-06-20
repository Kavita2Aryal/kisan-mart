<div class="ar-2-3">
    <div class="widget-11 card">
        <div class="card-header">
            <div class="card-title full-width">
                Top Product <div class="pull-right">Views</div>
            </div>
        </div>
        <div class="widget-11-table scroll-ing" style="overflow-y: auto; height: 400px;">
            <table class="table table-condensed table-hover">
                <tbody>
                    @forelse($top_product_views as $product)
                    <tr>
                        <td width="200" class="fs-12">
                            <a target="_blank" href="{{ $url.$product[0] }}">
                                {{ \Str::replace($replace_title, '', $product[1]) }}
                            </a>
                        </td>
                        <td width="75" class="text-right b-l b-dashed b-grey">
                            <span class="font-montserrat ">{{ $product[2] }}</span>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-t-15 p-b-15 p-l-20 p-r-20">
            <p class="small no-margin pull-right">
                <a href="{{ route('report.product-view') }}" class="hint-text font-montserrat"><strong> View All </strong></a>
            </p>
            <p class="small no-margin">
                <span class="hint-text font-montserrat">- From last 3 months</span>
            </p>
        </div>
    </div>
</div>