var page = 1;

function getNow(){
    $('.ImageBox').html(
        $('<img/>', {src: "./web-data/1/" + page + ".jpg", class: 'Image'})
    );
    for(var i=1;i<=2;++i){
        new Image().src = "./web-data/1/" + (page+i) + ".jpg";
        new Image().src = "./web-data/1/" + (page-i) + ".jpg";
    }
}

$('.container').on('keydown',function(event) {
    if(event.keyCode=="65"){
        --page;
        
    }else if(event.keyCode == "68"){
        ++page;
        
    }
    getNow();
    $('.pagination .page').eq(0).text(page);
    $('.pagination .page').eq(1).text(page);
});

$(function() {
    getNow();
    $(document).prop('title', page + ' | BOKK');
    $('.container').focus();
});
