<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>
   <?php echo ($cate["name"]); ?>
  </title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="/Public/home/css/style.scss.css" rel="stylesheet" type="text/css" media="all">
	<link rel="stylesheet" media="all" href="/Public/home/css/additional-checkout-buttons-e666b0b8a20c90d1eaafcc0f38897f2b4ab8af21f68426b37926e48a2ae452c2.css">
	<script type="text/javascript" src="/Public/home/js/jquery.js"></script>
	  <script src="/Public/home/js/shop.js" type="text/javascript"></script>

</head>
<style type="text/css" id="26450328198"></style>

<body id="buzzy-bee-amp-friends-official-online-store" class="template-index">

<div class="wrapper">

  <header class="site-header">
    <div class="cart-summary accent-text">
      <p class="large--left medium-down--hide">
        <a href="<?php echo U('Login/index');?>" id="customer_login_link">Log in</a> or <a href="<?php echo U('Login/register');?>" id="customer_register_link">Create an account</a>
      </p>
      <p id="cart-count" class="large--right">
        <a class="no-underline" href="<?php echo U('Shop/cart');?>">0 item<span id="cart-total-small">($0.00)</span></a> ·
        <a href="">Check out</a>
      </p>
      <form action="<?php echo U('Index/search');?>" method="get" id="search-form" role="search" class="large--right">
        <input name="q" type="text" id="search-field" placeholder="Search store..." class="hint">
        <button type="submit" value="" name="submit" id="search-submit" class="icon-fallback-text">
          <span class="icon icon-search" aria-hidden="true"><img src="/Public/home/images/search.png"></span>
          <span class="fallback-text" style="display:none;">Search</span>
        </button>
      </form>
      <a href="<?php echo U('Shop/cart');?>" id="cart-total"><span id="cart-price">$0</span></a>
    </div>
    <div class="grid-full nav-bar nav-bar--left">
      <div class="grid-item col-5 medium-down--col-12">
        <a id="logo" href="/" role="banner">
          <img src="/Public/home/images/logo.png" alt="Buzzy Bee &amp; friends Online Store">
        </a>
        <h1 class="hidden">Buzzy Bee &amp; friends Online Store</h1>
      </div>
      <div class="grid-item col-7 medium-down--col-12">
        <nav id="navWrap" role="navigation">
          <ul id="nav">
            <li class="nav-item first active">
              <a class="nav-item-link" href="/">Home</a>
            </li>
  
            <!-- <li class="nav-item">
              <a class="nav-item-link" href="https://buzzybeetv.com/">Visit BuzzyBeeTV.com</a>
            </li> -->
            <li id="moreMenu" class="nav-item has-dropdown"><a href="#" class="nav-item-link">More <span class="icon icon-arrow-down" aria-hidden="true"></span></a>
            	<ul id="moreMenu--list" class="sub-nav">
            		<?php if(is_array($shopCateOne)): foreach($shopCateOne as $key=>$sco): ?><li class="nav-item has-dropdown">
                		<a class="nav-item-link" href="/Index/shopCate?cid=<?php echo ($sco["id"]); ?>&<?php echo md5($sco.id);?>"><?php echo ($sco["name"]); ?> <span class="icon icon-arrow-down" aria-hidden="true"></span></a>
						<!-- <ul class="sub-nav">
							<li class="sub-nav-item first">
							<a class="sub-nav-item-link first " href="/collections/wooden-toys">Wooden 1Toys</a>
							</li>
							<li class="sub-nav-item">
							<a class="sub-nav-item-link  " href="/collections/soft-plush-toys">Soft/Plush Toys</a>
							</li>
							<li class="sub-nav-item">
							<a class="sub-nav-item-link  " href="/collections/clothing">Clothing</a>
							</li>
							<li class="sub-nav-item">
							<a class="sub-nav-item-link  " href="/collections/books">Books, DVDs and CDs</a>
							</li>
							<li class="sub-nav-item">
							<a class="sub-nav-item-link  " href="/collections/christmas-decorations">Christmas decorations</a>
							</li>
							<li class="sub-nav-item">
							<a class="sub-nav-item-link  " href="/collections/gift-cards">Gift Vouchers</a>
							</li>
							<li class="sub-nav-item">
							<a class="sub-nav-item-link  " href="/collections/jewellery">Jewellery</a>
							</li>
							<li class="sub-nav-item last">
							<a class="sub-nav-item-link  last" href="/collections/artworks">Buzzy inspired fine art</a>
							</li>
						</ul> -->
              		</li><?php endforeach; endif; ?>
				</ul>
			</li>
	</ul>
        </nav>
      </div>
    </div>

  </header>
<div id="content" role="main">
      

	<div class="grid">
	  <div class="grid-item col-5 medium-down--col-12">
	    <h1><?php echo ($cate["name"]); ?></h1>
	  </div>
	  <div class="grid-item col-7 medium-down--col-12 large--text-right">
	    <div class="filter">
	      <p>Browse by Tag</p>
	      <select class="coll-filter" name="coll-filter" size="1">
	        <option value="">All</option>
	        <option value="wooden-toys">wooden toys</option>
	      </select>
	    </div>
	  </div>

	</div>

    <div id="coll-product-list" class="grid-uniform product-list">
		<?php if(is_array($goodsList)): foreach($goodsList as $key=>$gl): ?><div class="grid-item large--col-3 medium--col-4 small--col-6">
		  <div class="coll-image-wrap">
		    <a href="/Shop/goods?id=<?php echo ($gl["id"]); ?>&t=<?php echo time();?>">
		      <img src="<?php echo ($gl["picimg"]); ?>" alt="<?php echo ($gl["name"]); ?>">
		    </a>
		  </div><!-- .coll-image-wrap -->
		  <div class="coll-prod-caption">
		    <a class="coll-prod-buy styled-small-button" href="/Shop/goods?id=<?php echo ($gl["id"]); ?>&t=<?php echo time();?>">
		      Buy
		    </a>
		    <div class="coll-prod-meta ">
		      <h5><a href="/Shop/goods?id=<?php echo ($gl["id"]); ?>&t=<?php echo time();?>"><?php echo ($gl["name"]); ?></a></h5>
		      <p class="coll-prod-price accent-text">
		        ￥<?php echo ($gl["pricenow"]); ?>
		      </p>
		    </div><!-- .coll-prod-meta -->
		  </div><!-- .coll-prod-caption -->
		</div><?php endforeach; endif; ?>
	</div>



<hr>
<div class="accent-text" id="breadcrumbs">
   <span><a href="/">Home</a></span>
   
      <span class="sep">/</span> <span><a href="/Index/shopCate?cid=<?php echo ($cate["id"]); ?>&<?php echo md5($cate.id);?>"><?php echo ($cate["name"]); ?></a></span> <span class="sep">/</span> <span> Wooden toys and Playmat </span> 
   
</div>




<script>
  Shopify.queryParams = {};
  if (location.search.length) {
    for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
      aKeyValue = aCouples[i].split('=');
      if (aKeyValue.length > 1) {
        Shopify.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1]);
      }
    }
  }
  var collFilters = jQuery('.coll-filter');
  collFilters.change(function() {
      var newTags = [];
      var newURL = '';
      delete Shopify.queryParams.page;
      collFilters.each(function() {
        if (jQuery(this).val()) {
          newTags.push(jQuery(this).val());
        }
      });
      
      newURL = '/collections/' + 'wooden-toys';
      if (newTags.length) {
        newURL += '/' + newTags.join('+');
      }
      var search = jQuery.param(Shopify.queryParams);
      if (search.length) {
        newURL += '?' + search;
      }
      location.href = newURL;
      
  });
  jQuery('.sort-by')
    .val('price-descending')
    .on('change', function() {
      Shopify.queryParams.sort_by = jQuery(this).val();
      location.search = jQuery.param(Shopify.queryParams).replace(/\+/g, '%20');
    });
</script>

    </div>
    <footer id="footer">
      <div class="grid">
        <div class="grid-item col-4 medium--col-6 small--col-12 ft-module" id="about-module">
          <ul class="social-links inline-list">
            <li>
              <a class="icon-fallback-text" href="https://twitter.com/BuzzyBeeTV/" title="Buzzy Bee &amp;amp; friends Online Store on Twitter">
                <span class="icon icon-twitter" aria-hidden="true"></span>
                <span class="fallback-text">Twitter</span>
              </a>
            </li>
            <li>
              <a class="icon-fallback-text" href="https://www.facebook.com/BuzzyBeeTV" title="Buzzy Bee &amp;amp; friends Online Store on Facebook">
                <span class="icon icon-facebook" aria-hidden="true"></span>
                <span class="fallback-text">Facebook</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="grid-item col-4 small--col-12 ft-module" id="mailing-list-module">
          <h3>Newsletter</h3>
          <p>We promise to only send you good things.</p>
          <form action="http://eepurl.com/bALmT1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
            <input type="email" placeholder="your-email@example.com" name="EMAIL" id="email-input">
            <input type="submit" class="btn styled-submit" value="Subscribe" name="subscribe" id="email-submit">
          </form>
          
        </div>
        </div>
      </footer><!-- #footer -->

      
      <div id="sub-footer">

        <div class="grid">
          <div class="grid-item col-12">
            <div class="footer-nav accent-text large--hide">
            <a href="http://www.buzzybee.co.nz/account/login" id="customer_login_link">Log in</a>
            <a href="http://www.buzzybee.co.nz/account/register" id="customer_register_link">Create an account</a>
            </div>
          </div>
          <div class="grid-item col-12 large--col-6">
            <div class="footer-nav accent-text" role="navigation">
              <a href="http://www.buzzybee.co.nz/search" title="Search">Search</a>
              <a href="http://www.buzzybee.co.nz/pages/contact-us" title="Contact Us">Contact Us</a>
              <a href="http://www.buzzybee.co.nz/pages/about-us" title="About Us">About Us</a>
              <a href="http://www.buzzybee.co.nz/pages/faqs" title="FAQs">FAQs</a>
              <a href="http://www.buzzybee.co.nz/pages/shipping" title="Shipping">Shipping</a>
              <a href="http://www.buzzybee.co.nz/pages/returns" title="Returns">Returns</a>
              <a href="http://www.buzzybee.co.nz/pages/privacy-policy" title="Privacy Policy">Privacy Policy</a>
              <a href="http://www.buzzybee.co.nz/pages/terms-of-use" title="Terms of Use">Terms of Use</a>
              <a href="http://www.buzzybee.co.nz/pages/contact-us" title="Wholesale Enquiries">Wholesale Enquiries</a>
              <a href="http://www.buzzybee.co.nz/blogs/news" title="Recall Notice">Recall Notice</a>
            </div>
            <p id="shopify-attr" class="accent-text" role="contentinfo">Copyright © 2016 <a href="http://www.buzzybee.co.nz/" title="">Buzzy Bee &amp; friends Online Store</a>. <a target="_blank" rel="nofollow" href="https://www.shopify.com/">Powered by Shopify</a>.</p>
          </div>
          <div class="grid-item col-12 large--col-6 large--text-right payment-types">
            <span>
              <img src="/Public/home/images/creditcards_paypal-dd71910a20fd73f78b4eed60e89331d4f4ceb38d55ef42e1e9935d78070ba3e2.svg">
            </span>
            
          </div>
        </div>

      <div class="footer-left-content"> </div> <!-- #footer-left-content -->
    </div><!-- #sub-footer -->

  




</body>

</html>