let div = $('#page-box-right'),
endMotorcycleBoxs = $('#page-boxs-end').offset().top;


function stickyDiv() {
    document.getElementById("page-box-right").style.verticalAlign = "auto";
let scrollTop = $(document).scrollTop() + $(window).height() - ($('#page-boxs-end').height() - $('#page-box-right').outerHeight());

if (scrollTop < endMotorcycleBoxs) {
    div.addClass("sticky");
    console.log('SCROLLTOP : ' + $(document).scrollTop());
    console.log('MOTOBOX END : ' + endMotorcycleBoxs);
    console.log('DOC HEIGHT : ' + $(document).outerHeight());


    if (scrollTop >= endMotorcycleBoxs) {

        div.css({
            "position" : "absolute",
            "top" : endMotorcycleBoxs - $('#page-box-right').outerHeight() + "px",
            "bottom" : "auto",
        });
    } else {
        div.css({
            "position" : "sticky",
            "top" : "auto",
            "vertical-align": "auto",
            "bottom" : "10%"
        });
    }
    }
}


$(document).scroll(function () {
stickyDiv();
});