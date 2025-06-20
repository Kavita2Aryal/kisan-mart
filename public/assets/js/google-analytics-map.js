am4core.ready(function () {
  am4core.useTheme(am4themes_animated);

  var chart = am4core.create("chartdiv", am4maps.MapChart);
  chart.geodata = am4geodata_worldLow;
  chart.projection = new am4maps.projections.Miller();

  var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
  polygonSeries.exclude = ["AQ"];
  polygonSeries.useGeodata = true;
  polygonSeries.data = geo_map_data;

  var polygonTemplate = polygonSeries.mapPolygons.template;
  polygonTemplate.tooltipText = "{name}: users {users}, views {views}";
  polygonTemplate.fill = chart.colors.getIndex(0).lighten(0.5);
  polygonTemplate.propertyFields.fill = "fill";

  var polygonTemplateHoverStyle = polygonTemplate.states.create("hover");
  polygonTemplateHoverStyle.properties.fill = chart.colors.getIndex(0);

  $(document).on('change', '.users-by-country-filter', function (e) {
    e.preventDefault();
    var filter = $(this).val();
    if (filter !== 'overall') {
      filter = filter + '-01';
    }
    $.ajax({
      type: 'GET',
      data: {
        filter: filter, //convert year to year-month (2021 = 2021-01)
      },
      url: users_by_country_route,
      async: false,
      success: function (response) {
        if (response.status) {
          var data = response.users_country;
          var content = '';
          if(data != null){
            data.map(function(item, index) {
                content += '<tr>'+
                '<td width="250" class="fs-12">'+item.name+'</td>'+
                '<td width="75" class="b-l b-dashed b-grey">'+item.users+'</td>'+
                '<td width="75" class="text-right b-l b-r b-dashed b-grey">'+item.views+'</td>'+
                '</tr>';
            });
            $('.users-by-country-content').html(content)
            polygonSeries.data = data; 
            chart.validateData();
          }
        } else {
          console.log('No data');
        }
      }
    });
  });
});