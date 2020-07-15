<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/jquery.tablesorter.widgets.min.js"></script>
<script>
    $(function(){
        $('table').tablesorter({
            widgets        : ['zebra', 'columns'],
            usNumberFormat : false,
            sortReset      : true,
            sortRestart    : true
        });
    });
</script>