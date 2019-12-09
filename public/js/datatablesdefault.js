// defaults en todas las datatable
$.extend( true,$.fn.dataTable.defaults,{
    'processing': true,
    'serverSide': true,
    'orderMulti': true,
    'paging':  false,
    'keys':    true,
    'stateSave': true,
    'blurable': false,
    'responsive': true,
    'colReorder': true,
    'dom': 'lBfrtip',
    'buttons':  [ 'copy', 'csv', 'excel','print' ],
    'language': {'url': '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'}
});

