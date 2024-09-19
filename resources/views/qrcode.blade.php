<style>

div {
  position: relative;
}

.inner-image {
  position: absolute;
  top: 47px;
  left: 52px;
}

</style>



  <div>
    <img src="{{ asset('/images/nfc_tag.png') }}" alt="bg" style="position: absolute" />
    <span class="inner-image">{!! QrCode::size(100)->generate("http://www." . request()->getHttpHost() . '/identify/' . $pet->token ); !!}</span>  
  </div>
        
