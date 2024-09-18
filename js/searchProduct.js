$(document).ready(() => {
  let searchProduct = $("#searchProduct");

  searchProduct.on("keypress", () => {
    if (!(searchProduct.val() == "" || searchProduct.val() == null)) {
      $.ajax({
        type: "POST",
        url: "./actions/searchProductAction.php",
        data: { searchProduct: searchProduct.val() },
        success: (searchProductRespo) => {
          $(".searchRes").html(searchProductRespo);
        },
      });
    } else {
      $(".searchRes").html("");
    }
  });

  // focus
  $("#searchProduct").on("focus", function () {
    $(".searchRes").css("zIndex", "100");
    $(".searchRes").css("opacity", "1");
  });

  // blur
  $("#searchProduct").on("blur", function () {
    // delay
    setTimeout(() => {
      $(".searchRes").css("zIndex", "-10000000000");
      $(".searchRes").css("opacity", "0");
    }, 100);
  });
});
