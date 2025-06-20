<div class="ar-2-3">
    <div class="widget-11 card">
        <div class="card-header">
            <div class="card-title full-width">
                Best Selling Brands
            </div>
        </div>
        <div class="widget-11-table scroll-ing" style="overflow-y: auto; height: 400px;">
            <table class="table table-condensed table-hover">
                <thead>
                    <th width="200">Brand Name</th>
                    <th width="75" class="text-right">Qty</th>
                    <th width="75" class="text-right">Total (NPR)</th>
                </thead>
                <tbody>
                    @forelse($top_product_brand as $row)
                    <tr>
                        <td width="250" class="fs-12">
                            <a target="_blank" href="{{ $url. '/search?brands=' .$row['alias'] }}">
                                {{ $row['name'] }}
                            </a>
                        </td>
                        <td width="75" class="text-right b-l b-dashed b-grey">
                            <span class="font-montserrat ">{{ $row['qty'] }}</span>
                        </td>
                        <td width="75" class="text-right b-l b-dashed b-grey">
                            <span class="font-montserrat ">{{ number_format($row['price'], 0, '', ',') }}</span>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-t-15 p-b-15 p-l-20 p-r-20">
            <p class="small no-margin pull-right">
                <a href="{{ route('report.product-brand') }}" class="hint-text font-montserrat"><strong> View All </strong></a>
            </p>
        </div>
    </div>
</div>