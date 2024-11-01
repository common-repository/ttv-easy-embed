function startSlides(wrapper,target) {
      var slidesToShow = 3;
      if (wrapper.offsetWidth < 768) {
    	slidesToShow = 2;
	  }
      if (wrapper.offsetWidth < 560) {
    	slidesToShow = 1;
	  }
      jQuery(target).slick({
          dots: false,
          slidesToShow: slidesToShow,
          slidesToScroll: 1,
          swipeToSlide: true,
          nextArrow: '<button type="button" class="slick-prev"><svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24"><path d="M15.41 16.09l-4.58-4.59 4.58-4.59L14 5.5l-6 6 6 6z"/><path d="M0-.5h24v24H0z" fill="none"/></svg></button>',
          prevArrow: '<button type="button" class="slick-next"><svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24"><path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/><path d="M0-.25h24v24H0z" fill="none"/></svg></button>',
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 560,
              settings: {
                slidesToShow: 1
              }
            }
          ]
      })
}