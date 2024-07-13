let WidthWindow = $(window).innerWidth();
let HeightWindows = $(window).innerHeight();
    resizeClearForm();

    function openForm() {
      console.log('WIDTH: ' + WidthWindow);
      console.log('HEIGHT: ' + HeightWindows);

        if(WidthWindow < 1080 || HeightWindows < 640) {
            console.log("window width < 1080px");
            document.getElementById("mobile-box").style.display = "none";
            document.getElementById("page-box-right").style.display = "grid";
            document.getElementById("page-box-right").style.margin = "0 auto";
            document.getElementById("page-box-right").style.width = "280px";
            document.getElementById("page-box-left").style.filter = "blur(3px)";
          // clickOutsideBox();
            
        }
    }

    //for close form
    function closeForm() {
        document.getElementById("mobile-box").style.display = "grid";
        document.getElementById("page-box-right").style.display = "none";
        document.getElementById("page-box-left").style.filter = "blur(0px)";
        document.getElementById("img-header").style.filter = "blur(0px)";
        document.getElementById("img-header").style.filter = "brightness(65%)";
    }

    //when resize a page
    function resizeClearForm(){
            window.addEventListener("resize", function(resizeWindow) {
                // create a media condition that targets viewports at least 1080 wide
                const mediaQueryMinWidth = window.matchMedia('(min-width: 1080px)');
                // check if the media query is true
                if (mediaQueryMinWidth.matches) {
                    location.reload();
                }

        });
    }

    //for close when click outside rent moto box 'motorcycle-box-right'
    function clickOutsideBox(){
        document.addEventListener('mouseup', function(clickOutsideBox) {
            let box = document.getElementById('page-box-right');
            if (!box.contains(clickOutsideBox.target)) {
                box.style.display = 'none';
                console.log('click');
                document.getElementById("page-box-left").style.filter = "blur(0px)";
                document.getElementById("mobile-box").style.display = "grid";
                document.getElementById("img-header").style.filter = "blur(0px)";
                document.getElementById("img-header").style.filter = "brightness(65%)";
                
            }
        });
    }