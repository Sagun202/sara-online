

<br>

<center>
  <h3>
    More to  <span style="color: red;">&nbsp;Love</span>
 </h3>
</center>

 


 


<div class="grid-section padd">
  @foreach ($products as $product)
  <div class="col" style="background: white; border-radius: 15px;">

 

 {{ FrontEndHandler::getProductCard($product) }}



</div>
   @endforeach

</div>

<br>