@extends('layouts.main')

@section('content')
<section class="tns-carousel tns-controls-lg mb-4 mb-lg-5">
    <div class="tns-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: false},&quot;992&quot;:{&quot;nav&quot;:false, &quot;controls&quot;: true}}}">
      <!-- Item-->
      <div class="px-lg-5" style="background-color: #161c36;">
        <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src={{ asset("img/home/hero-slider/home-banner1.jpg") }} alt="Women Sportswear">
          <div class="position-relative mx-auto py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
            <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">
              <h3 class="h2 text-light fw-light pb-1 from-bottom">Retactable Banners</h3>
              <h2 class=" display-5 from-bottom delay-1" style="color: #dd423b;">20% Discount</h2>
              <p class="fs-lg text-light pb-3 from-bottom delay-2">Vinyls, Canvas, Mesh...</p>
              <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="{{route('cart.index')}}">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
            </div>
          </div>
        </div>
      </div>
      <!-- Item-->
      <div class="px-lg-5" style="background-color: #0d172d;">
        <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src={{ asset("img/home/hero-slider/home-banner2.jpg") }} alt="Summer Collection">
          <div class="position-relative mx-auto  py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
            <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">
              <h3 class="h2 text-light fw-light pb-1 from-start">High Quality, Vivid Colors</h3>
              <h2 class="display-5 from-start delay-1" style="color: #dd423b;">Promotional Discounts</h2>
              <p class="fs-lg text-light pb-3 from-start delay-2">In Rigid products</p>
              <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="{{route('cart.index')}}">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>
            </div>
          </div>
        </div>
      </div>          
    </div>
  </section>
  <!-- Products grid (Trending products)-->
  <section class="container pt-4 mt-md-4 mb-5">
	  
	  <div class="row pt-4">
	  
    <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-banner.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Banner</span></h1>
        <p>Vinyl, Canvas, Poster, Fabric, Mesh</p>
        <ul>
			<a href="{{ route('productos.list', 1) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		  
		  <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-rigid.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Rigid</span></h1>
        <p>Coroplast, Foamcore, Styrene</p>
        <ul>
			<a href="{{ route('productos.list', 3) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		  
		  <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-adhesive.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Adhesive</span></h1>
        <p>Window, Statig Ling, Textured...</p>
        <ul>
			<a href="{{ route('productos.list', 4) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		  
		  <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-magnets.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Magnets</span></h1>
        <p>.030 Magnetic Material, Fridge...</p>
        <ul>
			<a href="{{ route('productos.list', 2) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		  
		  <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-banner-stand.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Banner Stand</span></h1>
        <p>Pull up Banner</p>
        <ul>
			<a href="{{ route('productos.list', 5) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		  
		   <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-clothing.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Clothing</span></h1>
        <p>DTF</p>
        <ul>
			<a href="{{ route('productos.list', 6) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		  <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-stickers.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Stickers/Labels</span></h1>
        <p>Stickers, Roll Labels</p>
        <ul>
			<a href="{{ route('productos.list', 7) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		    <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
    
 <div class="card2" style="margin-bottom: 20px;">
    <div class="image2">
      <img src="img/categories/categ-banner.jpg"/>
    </div>
    <div class="details2">
      <div class="center">
        <h1><span>Misc</span></h1>
        <p>Sample Kit, Others</p>
        <ul>
			<a href="{{ route('productos.list', 8) }}">
           <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i class="ci-eye fs-sm me-1"></i>SEE MORE</button></a>
        </ul>
      </div>
    </div>
  </div>	
		
    </div>
		  </div>
	  
  </section>
@endsection