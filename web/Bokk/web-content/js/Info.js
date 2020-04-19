var data = {
    bokk_id: 2, 
    EnglistTitle: "EnglishTitle",
    title: "Title", 
    MainImage: "./web-data/1/1.jpg", 
    uploadData: "2020_03_22",
    Count: "-1",
    Parodies: ["Parodies1"],
    Characters: ["Characters1"],
    Tags: ["Tags1", "Tags2", "Tags3", "Tags4", "Tags5", "Tags6", "Tags7", "Tags8", "Tags9", "Tags10", "Tags11", "Tags12", "Tags13", "Tags14", "Tags15"],
    Languages: ["Languages1", "chinese"],
    Categories: ["Categories1"]
}


function fetchInfo(){
    /*
    ajax_request('ajax_getBokkInfo',
        {
            data: {
                "bokk_id": bokk_id,
            }
        },
        {
            success: function (data){
                $('.Number a').text(data.bokk_id);
                $(document).prop('title', data.title+ ' | BOKK');
                $('.mainImageFrame').html(
                    $('<img/>', {src: data.MainImage, class: 'mainImage img-thumbnail'})
                );
                var fragment = document.createDocumentFragment();
                if ("Parodies" in data){
                    fragment.appendChild(getInfoItem("Parodies"));
                }
                if ("Characters" in data){
                    fragment.appendChild(getInfoItem("Characters"));
                }
                if ("Tags" in data){
                    fragment.appendChild(getInfoItem("Tags"));
                }
                if ("Languages" in data){
                    fragment.appendChild(getInfoItem("Languages"));
                }
                if ("Categories" in data){
                    fragment.appendChild(getInfoItem("Categories"));
                }
                $('.BokkInfo').append(fragment);
            }
        }
    );
    */
    
    $('.Number a').text(data.bokk_id);
    $(document).prop('title', data.title+ ' | BOKK');
    $('.mainImageFrame').html(
        $('<img/>', {src: data.MainImage, class: 'mainImage img-thumbnail'})
    );
    var fragment = document.createDocumentFragment();
    if ("Parodies" in data){
        fragment.appendChild(getInfoItem("Parodies"));
    }
    if ("Characters" in data){
        fragment.appendChild(getInfoItem("Characters"));
    }
    if ("Tags" in data){
        fragment.appendChild(getInfoItem("Tags"));
    }
    if ("Languages" in data){
        fragment.appendChild(getInfoItem("Languages"));
    }
    if ("Categories" in data){
        fragment.appendChild(getInfoItem("Categories"));
    }
    $('.BokkInfo').append(fragment);
}

function getInfoItem(arrayName){
    var Info = document.createElement("div");
    Info.innerHTML = arrayName + ": ";
    var next;
    for(next of data[arrayName]){
        var item = document.createElement("button");
        item.innerHTML = next;
        item.setAttribute("class", "btn btn-dark BokkInfoItem");
        var itemCount = document.createElement("span");
        itemCount.setAttribute("class", "badge badge-light BokkInfoItemCount");
        itemCount.innerHTML = "1";
        item.appendChild(itemCount);
        Info.appendChild(item);
    }
    return Info;
}

var common = {
    validateEmail: function (email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    },
    getUrlParam: function (paramName) {
        var match = window.location.search.match("[?&]" + paramName + "(?:&|$|=([^&]*))");
        return match ? (match[1] ? decodeURIComponent(match[1]) : "") : null;
    },
    formatPrice: function (x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
}

function Bokk_notFound() {
    $('#Alert_NOBOKK_ID').modal();
}

$(function () {
    $('#Alert_NOBOKK_ID').modal();
    if ($.isNumeric(common.getUrlParam('bid'))) {
        bokk_id = common.getUrlParam('bid');
        fetchInfo();
    } else {
        Bokk_notFound();
    }
});