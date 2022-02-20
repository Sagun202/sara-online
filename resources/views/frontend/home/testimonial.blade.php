



  <div class="section-padding padd" >
    <div class="contain" style=" border-radius: 15px;" >
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <br>
                    <center>
                        <h4>
                            Happy<span style="color: red;">Clients</span>
                         </h4>
                    </center>

                    <div class="section-borders">
                        <span></span>
                        <span class="black-border"></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">

       
         
            <div class="col-md-12">
                <div class="owl-carousel testimonials" >
                    @foreach ($testimonials as $testimonial)
                    <div class="card">
                        <div class="layer"></div>
                        <div class="content">
                          <p>{!! $testimonial->message !!}</p>
                          <div class="image">
                            <img src="{{ asset('storage/'.$testimonial->image) }}" alt="{{$testimonial->introduction}}">
                          </div>
                          <div class="details">
                            <h2>
                            {{$testimonial->name}}<br>
                              <span>{{$testimonial->introduction}}</span>            
                            </h2>
                          </div>
                        </div>
                      </div>

                      @endforeach

                   

                </div>
            </div>
        </div>
    </div>
</div>
<br>


<script>
    $(document).ready(function(){
$(".testimonials").owlCarousel({
  items:3,
//      autoplay:false,
  margin:30,
  loop:true,
  dots:true,
  responsive: {
                0:{
                  items: 2,
                   loop:true
                },
                480:{
                  items: 2,
                   loop:true
                },
                769:{
                  items: 4,
                   loop:true
                }
            }

});
});
</script>