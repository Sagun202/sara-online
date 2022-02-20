
<div class="owl-carousel banner owl-theme owl-loaded owl-drag">
    <div class="owl-stage-outer">
       <div class="owl-stage" style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
        @foreach ($sliders as $slider)
        <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
            <div class="item">
               <img src="{{ asset('storage/'.$slider->image) }}" alt="">
            </div>
         </div>
        @endforeach 
        
         
       </div>
    </div>
 </div>


 <script>
var owl = $('.banner');
owl.owlCarousel({
items:1, 
// items change number for slider display on desktop

loop:true,
margin:10,
autoplay:true,
autoplayTimeout:2000,
autoplayHoverPause:true,
dots:false
});

</script>
