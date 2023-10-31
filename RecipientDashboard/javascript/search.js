$(document).ready(function(){
    $('#searchForm').on('input', function(e){
        e.preventDefault();
        var searchValue = $('#searchInput').val();
        $.ajax({
            type: 'POST',
            url: 'functions/search.php',
            data: { search: searchValue },
            success: function(response){
                $('#searchResults').html(response);
            }
        });
    });
});