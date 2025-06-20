<div class="ar-2-3">
    <div class="widget-11 card">
        <div class="card-header">
            <div class="card-title full-width">
                Session Per Pages
            </div>
        </div>
        <div class="widget-11-table scroll-ing" style="overflow-y: auto; height: 400px;">
            <table class="table table-condensed table-hover">
                <thead style="position: sticky; top: 0; background-color:#ffff;">
                    <th width="250">Pages</th>
                    <th width="75" class="text-right">Page Views</th>
                    <th width="75" class="text-right">Sessions</th>
                    <th width="75" class="text-right">Duration(in second)</th>
                </thead>
                <tbody>
                    @forelse($session_durations as $row)
                    <tr>
                        <td width="250" class="fs-12">
                            <a target="_blank" href="{{ $url.$row['path'] }}">
                                {{ \Str::replace($replace_title, '', $row['title']) }} | {{ $url.$row['path'] }}
                            </a>
                        </td>
                        <td width="75" class="text-right b-l b-dashed b-grey">
                            <span class="font-montserrat ">{{ number_format($row['pageviews'], 0, '', ',') }}</span>
                        </td>
                        <td width="75" class="text-right b-l b-dashed b-grey">
                            <span class="font-montserrat ">{{ number_format($row['sessions'], 0, '', ',') }}</span>
                        </td>
                        <td width="75" class="text-right b-l b-dashed b-grey">
                            <span class="font-montserrat ">{{ number_format($row['sessionDuration'], 0, '', ',') }}</span>
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