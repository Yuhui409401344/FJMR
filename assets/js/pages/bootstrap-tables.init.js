function invoiceFormatter(e,t)
{return'<a href="#" class="btn-link" > Order #'+e+"</a>"}
function nameFormatter(e,t){return'<a href="#" class="btn-link" > '+e+"</a>"}
function dateFormatter(e,t){t.id;return'<span class="text-muted"> '+e+"</span>"}
function statusFormatter(e,t){
    var n;
    "接受"==e?n="success":"大幅修改"==e?n="warning":"小幅修改"==e?n="info":"拒絕"==e&&(n="danger");
    t.id;return'<div class="badge label-table badge-'+n+'"> '+e+"</div>"}

function timesFormatter(e,t){
        var n;
        "1"==e?n="blue":"2"==e?n="secondary":"3"==e?n="pink":"4"==e&&(n="dark");
        t.id;return'<div class="badge label-table badge-'+n+'"> '+e+"</div>"}
    
function priceSorter(e,t){return e=+e.substring(1),(t=+t.substring(1))<e?1:e<t?-1:0}

$(document).ready(function(){var t=$("#demo-custom-toolbar"),n=$("#demo-delete-row");t.on("check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table",function(){n.prop("disabled",!t.bootstrapTable("getSelections").length)}),n.click(function(){var e=$.map(t.bootstrapTable("getSelections"),function(e){return e.id});t.bootstrapTable("remove",{field:"id",values:e}),n.prop("disabled",!0)})}),$(window).on("load",function(){$('[data-toggle="table"]').show()}),window.icons={refresh:"mdi mdi-refresh",toggle:"fa-refresh",toggleOn:"fa-toggle-on",toggleOff:"fa-toggle-on",columns:"fas fa-th-list",paginationSwitchDown:"glyphicon-collapse-down icon-chevron-down"};