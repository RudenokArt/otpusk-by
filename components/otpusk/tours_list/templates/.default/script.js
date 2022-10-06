$('document').ready(function () {

  $( ".tours_list_filter-date" ).datepicker({
    dateFormat: "dd.mm.yy",
  });

  $('#tour_detail_page_slider').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  dots:true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        dots:true,
        infinite: true,
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        dots:true,
        infinite: true,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots:true,
        infinite: true,
      }
    }
  ]
});
});
