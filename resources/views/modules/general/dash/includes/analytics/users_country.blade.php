<div class="ar-2-3">
    <div class="widget-11 card">
        <div>
            <div class="widget-11-table" style="height: 400px;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-xl-6">
                            <div class="form-group input-group transparent m-l-5 m-t-20">
                                <div class="input-group-prepend test">
                                    <span class="input-group-text transparent text-capitalize">Year:</span>
                                </div>
                                <select class="form-control users-by-country-filter input-sm" id="users-by-country-filter">
                                    @for($i=0; $i<=$difference; $i++) @php $value=$start_year + $i; @endphp <option value="{{$value}}" @if($value==$current_year) selected @endif>{{ $value }}</option>
                                        @endfor
                                        <option value="overall">OverAll</option>
                                </select>
                            </div>
                        </div>
                        <div class="m-t-5 scroll-ing" style="overflow-x:hidden; overflow-y:auto; height: 300px;">
                            <table class="table table-condensed table-hover">
                                <thead style="position: sticky; top: 0; background-color:#ffff;">
                                    <th width="200">Country</th>
                                    <th width="100">Users</th>
                                    <th width="100" class="text-right">Views</th>
                                </thead>
                                <tbody class="users-by-country-content">
                                    @if($users_country != null)
                                        @foreach($users_country as $row)
                                        <tr>
                                            <td width="200" class="fs-12">
                                                {{ $row['name']}}
                                            </td>
                                            <td width="100" class="b-l b-dashed b-grey">
                                                {{ $row['users']}}
                                            </td>
                                            <td width="100" class="text-right b-l b-r b-dashed b-grey">
                                                {{ $row['views']}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id="chartdiv" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>