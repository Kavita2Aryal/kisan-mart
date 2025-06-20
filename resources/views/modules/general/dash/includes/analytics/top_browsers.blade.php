<div class="ar-2-3">
    <div class="widget-11 card">
        <div class="card-header">
            <div class="card-title full-width">
                Top Browsers <div class="pull-right">Sessions</div>
            </div>
        </div>
        <div class="widget-11-table scroll-ing" style="overflow-y: auto; height: 400px;">
            <table class="table table-condensed table-hover">
                <tbody>
                    @forelse($top_browsers as $page)
                    <tr>
                        <td width="100" class="fs-12">
                            {{ $page['browser'] }}
                        </td>
                        <td width="75" class="text-right b-l b-dashed b-grey">
                            <span class="font-montserrat ">{{ number_format($page['sessions'], 0, '', ',') }}</span>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-t-15 p-b-15 p-l-20 p-r-20">
            <p class="small no-margin">
                <span class="hint-text font-montserrat">- From last 30 days</span>
            </p>
        </div>
    </div>
</div>