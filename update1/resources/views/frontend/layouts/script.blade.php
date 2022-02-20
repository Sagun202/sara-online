<script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.min.js"></script>

<!-- bootstrap js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
<!-- Slider Js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/revolution-slider.js"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/js/revolution-extension.js"></script>
<!-- owl.carousel.min js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>

<!-- jquery.mobile-menu js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/mobile-menu.js"></script>

<!--jquery-ui.min js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/jquery-ui.js"></script>

<!-- main js -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/main.js"></script>

<!-- countdown js -->

<script type="text/javascript" src="{{ asset('frontend') }}/js/countdown.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@stack('js')
<script>
  var swiper = new Swiper(".swiper-container", {
    autoPlay: true,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>
<script>
  var swiper = new Swiper(".topPro-swiper-container", {
    slidesPerView: 7,
    spaceBetween: 30,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints:{
      0:{
        slidesPerView:2
      },
      400:{
        slidesPerView:2
      },
      600:{
        slidesPerView:3
      },
      1200:{
        slidesPerView:5
      },
      1400:{
        slidesPerView:7
      }
    },

  });
</script>
<script>
  var swiper = new Swiper(".featured-swiper-container", {
    slidesPerView: 7,
    spaceBetween: 30,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints:{
      0:{
        slidesPerView:2
      },
      400:{
        slidesPerView:2
      },
      600:{
        slidesPerView:3
      },
      1200:{
        slidesPerView:5
      },
      1400:{
        slidesPerView:7
      }
    },

  });
</script>
<script>
  $(document).ready(function() {
    $(".register-form-open").click(function() {
      $(".register-modal-form").show();
      $(".login-modal-form").hide();
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(".login-form-open").click(function() {
      $(".register-modal-form").toggle();
      $(".login-modal-form").toggle();
    });
  });
</script>