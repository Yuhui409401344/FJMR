function fieldFormatter(e,t){
    var n;
    "管理與政策"==e?n="success":"國際企業"==e?n="warning":"行銷管理"==e?n="info":"國際貿易"==e?n="primary":"生產與作業管理"==e?n="dark":"統計"==e?n="white":"人力資源管理"==e?n="light":"數量方法"==e?n="blue":"資訊管理"==e?n="pink":"會計"==e?n="secondary":"財務管理"==e?n="blue":"審計"==e&&(n="danger");
    t.id;return'<div class="badge label-table badge-'+n+'"> '+e+"</div>"}

$(window).on("load",function(){$("#demo-foo-row-toggler").footable(),
$("#demo-foo-accordion").footable().on("footable_row_expanded",function(o){$("#demo-foo-accordion tbody tr.footable-detail-show").not(o.row).each(function(){$("#demo-foo-accordion").data("footable").toggleDetail(this)})}),$("#demo-foo-pagination").footable(),
$("#demo-show-entries").change(function(o){o.preventDefault();var t=$(this).val();
    $("#demo-foo-pagination").data("page-size",t),
    $("#demo-foo-pagination").trigger("footable_initialized")});var t=$("#demo-foo-filtering");t.footable().on("footable_filtering",function(o){var t=$("#demo-foo-filter-status").find(":selected").val();o.filter+=o.filter&&0<o.filter.length?" "+t:t,o.clear=!o.filter}),
    $("#demo-foo-filter-status").change(function(o){o.preventDefault(),t.trigger("footable_filter",{filter:$(this).val()})}),
    $("#demo-foo-filter-status2").change(function(o){o.preventDefault(),t.trigger("footable_filter",{filter:$(this).val()})}),
    $("#demo-foo-search").on("input",function(o){o.preventDefault(),t.trigger("footable_filter",{filter:$(this).val()})});var e=$("#demo-foo-addrow");e.footable().on("click",".demo-delete-row",function(){var o=e.data("footable"),t=$(this).parents("tr:first");o.removeRow(t)}),
    $("#demo-input-search2").on("input",function(o){o.preventDefault(),e.trigger("footable_filter",{filter:$(this).val()})}),
$("#demo-btn-addrow").click(function(){e.data("footable").appendRow('<tr><td style="text-align: center;"><button class="demo-delete-row btn btn-danger btn-xs btn-icon"><i class="fa fa-times"></i></button></td><td>Adam</td><td>Doe</td><td>Traffic Court Referee</td><td>22 Jun 1972</td><td><span class="badge label-table badge-success   ">Active</span></td></tr>')})});
