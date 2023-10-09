jQuery(document).ready(function($){
    $("a").click(function(event){
        link=$(this).attr("href");
        $.ajex({
            url: link,
        })
        .done(function(){
            $("page").empty().append(html);
        });
        // .fail(function(){
        //     console.log("error");
        // });
        // .always(function(){
        //     console.log("complete");
        // });
        return false;
    });
});