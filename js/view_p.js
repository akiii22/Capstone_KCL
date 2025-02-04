$(document).ready(()=>{


// swiper also like
const swiper = new Swiper(".alsoLike", {
    slidesPerView: 5,
    centeredSlides: true,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      type: "fraction",
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      speed: 1000,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });




  // magnifier
  var $loupe = $(".loupe"),
    loupeWidth = $loupe.width(),
    loupeHeight = $loupe.height();

$(document).on("mouseenter", ".left", function (e) {
    var $currImage = $(this),
        $img = $('<img/>')
        .attr('src', $('img', this).attr("src"))
        .css({ 'width': $currImage.width() * 2, 'height': $currImage.height() * 2 });

    $loupe.html($img).fadeIn(100);
    
    $(document).on("mousemove",moveHandler);
                   
    function moveHandler(e) {
        var imageOffset = $currImage.offset(),
            fx = imageOffset.left - loupeWidth / 2,
            fy = imageOffset.top - loupeHeight / 2,
            fh = imageOffset.top + $currImage.height() + loupeHeight / 2,
            fw = imageOffset.left + $currImage.width() + loupeWidth / 2;
        
        $loupe.css({
            'left': e.pageX - 75,
            'top': e.pageY - 75
        });
        
        var loupeOffset = $loupe.offset(),
            lx = loupeOffset.left,
            ly = loupeOffset.top,
            lw = lx + loupeWidth,
            lh = ly + loupeHeight,
            bigy = (ly - loupeHeight / 4 - fy) * 2,
            bigx = (lx - loupeWidth / 4 - fx) * 2;

        $img.css({ 'left': -bigx, 'top': -bigy });

        if (lx < fx || lh > fh || ly < fy || lw > fw) {
            $img.remove();
            $(document).off("mousemove",moveHandler);
            $loupe.fadeOut(100);
        }
    }
});









});