$("document").ready(function(){
    $("#new_project").on("pjax:end", function() {
        $.pjax.reload({container:"#project"});  //Reload GridView
    });
});
