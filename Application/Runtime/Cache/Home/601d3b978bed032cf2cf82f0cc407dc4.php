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

	<script type="text/javascript" src="/Public/home/js/sp.js"></script>

  <script src="/Public/home/js/shop.js" type="text/javascript"></script>
 </head>
<style type="text/css" id="26450328198"></style>

<body id="buzzy-bee-amp-friends-official-online-store" class="template-index">

<div class="wrapper">

  <header class="site-header">
    <div class="cart-summary accent-text">
      <p class="large--left medium-down--hide" <?php if($user): ?>style="display:none;"<?php endif; ?> >
        <a href="<?php echo U('Login/index');?>" id="customer_login_link">登录</a> or <a href="<?php echo U('Login/register');?>" id="customer_register_link">注册账号</a>
      </p>
      <p class="large--left medium-down--hide" <?php if(!$user): ?>style="display:none;"<?php endif; ?>>
          登录账号 <a href="/Home/User/index"><?php echo ($user["username"]); ?></a> · <a href="/Login/logout" id="customer_logout_link">退出</a>
      </p>
      <p id="cart-count" class="large--right">
        <a class="no-underline" href="<?php echo U('Shop/listShopCart');?>"><?php echo ($shopCartCount); ?> item<span id="cart-total-small">(￥<?php echo ($shopCartAmount); ?>)</span></a> ·
        <a href="">退出</a>
      </p>
      <form action="<?php echo U('Index/search');?>" method="get" id="search-form" role="search" class="large--right">
        <input name="q" type="text" id="search-field" placeholder="Search store..." class="hint">
        <button type="submit" value="" name="submit" id="search-submit" class="icon-fallback-text">
          <span class="icon icon-search" aria-hidden="true"><img src="/Public/home/images/search.png"></span>
          <span class="fallback-text" style="display:none;">Search</span>
        </button>
      </form>
      <a href="<?php echo U('Shop/listShopCart');?>" id="cart-total"><span id="cart-price" style="opacity:1;">￥<?php echo ($shopCartAmount); ?></span></a>
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

<div class="wrapper">

    <div id="content" role="main">

	
     <div class="clearfix page-container cartempty" <?php if(!$shopCartList): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?> >
	  <div class="text-center">
	    <h2>我的购物车</h2>
	    <p>您暂时没有商品加入购物车!</p>
	    <p>你可以继续购买,<a href="/">点击这里</a>.</p>
	  </div>
	</div>

      <div class="clearfix page-container cartyou" <?php if($shopCartList): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>  >
  		<h1>我的购物车</h1>
	  	 <form action="" method="post" novalidate="" onsubmit="return false;">

	  	 <?php if(is_array($shopCartList)): foreach($shopCartList as $key=>$sc): ?><div class="cart-row" data-id="28094382929">
	        <div class="grid">
		          <div class="grid-item col-7 medium-down--col-12">
			            <div class="grid cart-detail">
				              <div class="grid-item col-4">
				                <a href="/Shop/goods?id=<?php echo ($sc["gid"]); ?>&t=<?php echo time();?>">
				                  <img src="<?php echo ($sc["picimg"]); ?>" alt="<?php echo ($sc["name"]); ?>">
				                </a>
				              </div>
				              <div class="grid-item col-8">
				                <h4 class="cart-product-title"><a href="/Shop/goods?id=<?php echo ($sc["gid"]); ?>&t=<?php echo time();?>"><?php echo ($sc["name"]); ?></a></h4>
								<h6>
									<?php if(is_array($sc["attrall"])): foreach($sc["attrall"] as $a=>$attr): echo ($attr["attrname"]); ?>&nbsp;<?php echo ($sc["name"]); endforeach; endif; ?>
								</h6>
				              </div>
			            </div>
		          </div>
		        
		          <div class="grid-item medium-down--col-4 small--hide"></div>
		            <div class="grid-item col-5 medium--col-8 small--col-12">
			            <div class="display-table">
				              <div class="display-table-cell col-2 small--col-3" style="width:20%;">
				                <span class="nowrap">￥<?php echo ($sc['pricenow']+$sc['attrprice']); ?></span> <small>(单价)</small>
				              </div>
				              <div class="display-table-cell col-2 small--col-3">
				                <input type="number" name="number"
				                 <?php if($user): ?>data-number="<?php echo ($sc["number"]); ?>" onblur="saveNumber(<?php echo ($sc["id"]); ?>,this)"
								 <?php else: ?>
									data-number="<?php echo ($sc["number"]); ?>" onblur="saveNumber(<?php echo ($key); ?>,this)"<?php endif; ?> 
				                  value="<?php echo ($sc["number"]); ?>" min="0">
				              </div>
				              <div class="display-table-cell col-6 small--col-6">
				                <strong class="nowrap">￥<?php echo ($sc["amount"]); ?></strong>
				              </div>
				              <div class="display-table-cell text-right">

				               <?php if($user): ?><a href="javascript:void(0);" onclick="delthis(<?php echo ($sc["id"]); ?>,this)">
				                  <span class="fallback-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Public/home/images/@H{Q6QZR7H0)VWS63ZW4YC3.png"></span>
				                </a>
								 <?php else: ?>
								   <a href="javascript:void(0);" onclick="delthis({$key},this)">
					                  <span class="fallback-text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Public/home/images/@H{Q6QZR7H0)VWS63ZW4YC3.png"></span>
					                </a><?php endif; ?> 

				              </div>
			            </div>
		            </div>
	       		</div>
	       </div><?php endforeach; endif; ?>
    




	    <div class="grid">
	        <!-- <div id="cart-notes" class="grid-item col-5 small--col-12" {$allAmount}>
	          <p>留言</p>
	          <textarea class="styled-input" id="cart-notes-area" name="note"></textarea>
	        </div>  -->
	       <div id="cart-meta" class="grid-item text-right col-7 small--col-12" style="width:100%;">
	        <h3 id="cart-subtotal">商品总金额 <em>￥<span id="amount"><?php echo ($allAmount); ?></span></em><br/>
	        </h3>
	        <h3 id="estimated-shipping" style="display:block">邮费 <em>
	        	<?php if($shopSet['postage']): ?>￥<?php echo ($shopSet['postage']); else: ?>免邮<?php endif; ?></em></h3>

	        <a href="<?php echo U('Shop/addMessage');?>" id="checkout-button" class="styled-submit" type="submit" name="checkout" value="">下一步</a>
<!--            <div class="additional-checkout-buttons">
 	<button name="goto_pp" type="submit" id="paypal-express-button" class="additional-checkout-button additional-checkout-button--paypal-express" value="paypal_express">Checkout with <img alt="PayPal" src="//cdn.shopify.com/s/assets/checkout/easy-checkout-btn-paypal-cadb680457a51ea1df32214b16adad91083c80679c7f5017e35c731832e59b90.png"></button>
</div> -->
	      </div>
	    </div>



<!-- 
	  <div id="is-a-gift" style="clear: left; margin: 30px 0" class="clearfix rte">
	   
	    <p>
	      <label style="display:block" for="gift-note">贺卡内容(免费可选):</label>
	      <textarea name="giftnote" id="gift-note"></textarea>
	    </p>
	  </div>

 -->




<style>
  #updates_5762879940 { display: none; }
</style>
</form>
   <!-- if cart.item_count > 0 >
	<div id="shipping-calculator">

	  <h5>Shipping rates calculator</h5>

	  <div class="grid">

	    <div class="grid-item col-3 medium--col-6 small--col-12">
	      <label for="address_country">Country</label>
	      <select id="address_country" name="address[country]" data-default="New Zealand"></select>
	    </div>
	    <div class="grid-item col-3 medium--col-6 small--col-12" id="address_province_container">
	      <label for="address_province" id="address_province_label">Region</label>
	      <select id="address_province" class="address_form" name="address[province]" data-default=""></select>
	    </div>
	    <div class="grid-item col-2 medium--col-6 small--col-12">
	      <label for="address_zip">Zip / Postal Code</label>
	      <input type="text" id="address_zip" class="styled-input" name="address[zip]">
	    </div>
	    <div class="grid-item col-4 medium--col-6 small--col-12">
	      <label for="get-rates-submit" class="small--hide">&nbsp;</label>
	      <input type="submit" id="get-rates-submit" class="get-rates styled-submit" value="Get Rates">
	    </div>

	  </div><!-- .grid 

	  <div id="wrapper-response"></div>

	</div><!-- #shipping-rates-calculator 

-->



<div id="breadcrumbs" class="accent-text">
  你想继续购买 <a href="/">点击这里</a>.
</div>


    </div><!-- #content -->

    

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
</div>

<script type="text/javascript">
$(function(){
	$("input[name='checkout']").click(function(){
		/*var note=$("textarea[name='note']").val();
		//var giftnote=$("textarea[name='giftnote']").val();
		$.ajax({
			 type: "post",
             url: "/Shop/addMessage",
             data: {"note":note,"giftnote":giftnote},
             dataType: "json",
             success: function(data){
             	if(data.status==0){
             		
             	}else if(data.status==1){
             		
             	}
             }
		})*/



	})
})	

</script>



</body>

</html>