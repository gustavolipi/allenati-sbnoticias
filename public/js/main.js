$(document).ready(function () {
  if ($('.owl-destaques').length) {
    $(".owl-destaques").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplay: true,
      margin: 0,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
        }

      }
    })
  }

  if ($('.owl-social').length) {
    $(".owl-social").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplay: true,
      margin: 0,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
        }

      }
    })
  }

  if ($('.owl-classificados').length) {
    $(".owl-classificados").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      autoplay: true,
      margin: 30,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
        },
        768 : {
          items: 2
      }
      }
    })
  }

  if ($('#paginacao').length) {
    var load = false
    var url = window.location.search;
    url = url.replace(/&?((page)|(pg))=([^&]$|[^&]*)/i, ""); //remove page or pg
    var queryString = url.substring(url.indexOf('?') + 1);
    queryString = queryString == "" ? queryString : queryString + "&";
    var hrefTextPrefix = href + "?" + queryString + "page=";

    $('#paginacao').twbsPagination({
      totalPages: total,
      visiblePages: 5,
      startPage: currentPage,
      first: 'Primeira',
      last: 'Última',
      next: 'Próximo',
      prev: 'Anterior',
      onPageClick: function (event, page) {
        if (load) {
          window.location.href = hrefTextPrefix + page
        }
        load = true
      }
    });
  }

  $(".menu-segmentos h3").click(function () {
    $("#segmentos").toggle();
  });
});