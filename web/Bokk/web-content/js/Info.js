var data = {
    bokk_id: 2, 
    EnglistTitle: "(C96) [Arenowaiyo. (Aree)] JS Idol Tokubetsu Eigyou (Jou) (THE IDOLM@STER CINDERELLA GIRLS) [Chinese] [臭鼬娘漢化組]",
    title: "(C96) [あれのわいよ。 (あれー)] JSアイドル特別営業(上) (アイドルマスター シンデレラガールズ) [中国翻訳]", 
    MainImage: "./web-data/1/1.jpg", 
    uploadData: "2020_03_22",
    Count: "25",
    Parodies: ["theidolmaster"],
    Characters: ["haruyuuki"],
    Tags: ["group", "lolicon", "stockings", "anal", "ahegao", "doublepenetration", "dilf", "bbm", "mmfthreesome", "catgirl", "scat", "kemonomimi", "blackmail", "gloves", "lowscat"],
    Languages: ["translated", "chinese"],
    Categories: ["doujinshi"]
    
}


function fetchInfo(){
    
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
    
    /*
    $('.BokkInfo').html(
        $
    );
    $
    */
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

$(function () {
    fetchInfo();
});