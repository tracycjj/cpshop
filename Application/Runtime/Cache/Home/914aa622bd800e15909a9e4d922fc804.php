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
<div id="content" role="main">
    <div class="clearfix" id="product-content" itemscope="" itemtype="http://schema.org/Product">
  
	    <form action="" method="post" enctype="multipart/form-data" onclick="return false">
	    <div class="grid">
	      <div id="product-photos" class="grid-item col-6 small--col-12">
	          <div id="product-photo-container">
	              <a href="" rel="" class="cboxElement">
	                <img src="<?php echo ($goodsMess["goodsimg"]["0"]); ?>" alt="<?php echo ($goodsMess["name"]); ?>" data-image-id="" id="productPhotoImg">
	              </a>
	          </div>
	      </div><!-- #product-photos -->
	      <div class="grid-item col-6 small--col-12">
	        <h1 itemprop="name"><?php echo ($goodsMess["name"]); ?></h1>
	        <h3 itemprop="brand"><a href="/collections/vendors?q=Lion%20Rock%20Online" title=""><?php echo ($cate["name"]); ?></a></h3>
	        <hr>
	        <div id="product-prices" itemprop="offers" itemscope="" itemtype="">
	          <meta itemprop="priceCurrency" content="NZD">
	          
	            <link itemprop="availability" href="">
	          
	          <p id="product-price">
	          	<font style="display: inline;color: #807777;font-size: 35px;">￥</font>
	          	<span class="product-price"><?php echo ($goodsMess["pricenow"]); ?></span>
	          </p>
	        </div>
	        <hr class="hr--small hr--invisible">
			<span id="goodsprice" style="display:none;"><?php echo ($goodsMess["pricenow"]); ?></span>
			<input type="hidden" name="attrid" value="0"/>
			<input type="hidden" name="attrname" value="0"/>
			<input type="hidden" name="amount" value="<?php echo ($goodsMess["pricenow"]); ?>"/>
			<input type="hidden" name="gid" value="<?php echo ($goodsMess["id"]); ?>"/>
	        <div>
	          <div class="select-wrappers">
	          	<?php if(is_array($goodsMess["attrArr"])): foreach($goodsMess["attrArr"] as $key=>$attr): ?><div class="selector-wrapper">
		            <label><?php echo ($attr["name"]); ?></label>
		            <select name="<?php echo ($attr["id"]); ?>" class="single-option-selector"  data-price="111">
		            	<option value="0|0|0">未选择</option>
		            	<?php if(is_array($attr["sonattr"])): foreach($attr["sonattr"] as $key=>$sonattr): ?><option value="<?php echo ($sonattr["id"]); ?>|<?php echo ($sonattr["price"]); ?>|<?php echo ($sonattr["attrname"]); ?>" data-price="<?php echo ($sonattr["price"]); ?>"><?php echo ($sonattr["attrname"]); ?></option><?php endforeach; endif; ?>
		            </select>
	            </div><?php endforeach; endif; ?>
	          </div>
	          
	            <div class="selector-wrapper">
	              <label for="quantity">数量</label>
	              <input id="quantity" type="number" name="quantity" class="styled-input" value="1" min="1">
	            </div>
	            <script type="text/javascript">
	            
	            </script>
	          <hr>
	        </div>

	        <div id="backorder" class="hidden" style="display: block; opacity: 0;">
	          <p><span id="selected-variant"></span> is on back order</p>
	          <hr>
	        </div>

	        <button type="submit" name="add" id="add" class="btn" style="opacity: 1;">
	          <span id="addText">Add to Cart</span>
	        </button>
	        <hr>
	          <div id="product-description" class="below">
	            <div id="full_description" class="rte" itemprop="description">
	              <?php echo (htmlspecialchars_decode($goodsMess["content"])); ?>
	            </div>
	          </div>

	          
	            <hr>
	            <h4>Share this Product</h4>
	            

			<div class="social-sharing is-clean" data-permalink="http://www.buzzybee.co.nz/products/buzzy-bee-playmat">
			    <a target="_blank" href="//www.facebook.com/sharer.php?u=http://www.buzzybee.co.nz/products/buzzy-bee-playmat" class="share-facebook">
			      <span class="icon icon-facebook"></span>
			      <span class="share-title">Share</span>
			      <span class="share-count">0</span>
			    </a>
			</div>
			</div>
	    </div>
	    </form>
	  
</div><!-- #product-content -->

    <hr>

    <div class="related-products-container">
      <h3>相似产品</h3>
      <div class="grid-uniform related-products-list product-list">
		
		<?php if(is_array($similar)): foreach($similar as $key=>$sl): ?><div class="grid-item large--col-3 medium--col-4 small--col-6">
			  <div class="coll-image-wrap" style="height: 296px;">
			    <a href="/Shop/goods?id=<?php echo ($sl["id"]); ?>&t=<?php echo time();?>">
			      <img src="<?php echo ($sl["picimg"]); ?>" alt="<?php echo ($sl["name"]); ?>">
			    </a>
			  </div><!-- .coll-image-wrap -->
			  <div class="coll-prod-caption">
			    <a class="coll-prod-buy styled-small-button" href="/Shop/goods?id=<?php echo ($sl["id"]); ?>&t=<?php echo time();?>">
			      Buy
			    </a>
			    <div class="coll-prod-meta ">
			      <h5><a href="/Shop/goods?id=<?php echo ($sl["id"]); ?>&t=<?php echo time();?>"><?php echo ($sl["name"]); ?></a></h5>
			      <p class="coll-prod-price accent-text">
			       ￥<?php echo ($sl["pricenow"]); ?>
			      </p>
			    </div><!-- .coll-prod-meta -->
			  </div><!-- .coll-prod-caption -->
			</div><?php endforeach; endif; ?>

      </div>
    </div><!-- #additional-products-container -->

  


<hr>
<div class="accent-text" id="breadcrumbs">
   <span><a href="/">Home</a></span>
   
      
      <span class="sep">/</span> 
      <span><a href="/Index/shopCate?cid=<?php echo ($cate["id"]); ?>&<?php echo md5($cate.id);?>"><?php echo ($cate["name"]); ?></a></span>       
      <span class="sep">/</span> <span><?php echo ($goodsMess["name"]); ?></span>
   
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
</div>
<style type="text/css">
.addCartFail{width:300px;height:auto;padding-bottom:20px;background:black;opacity:0.8;border-radius: 5px;position:absolute;top:30%;right:20%;display:none;}	
.success_info,.fail_info{width:95%;margin:0 auto;line-height: 30px;font-weight: bold;color:white;text-align: center;margin-top:20px;color:orange;}
.fail_jx{display:inline-block;width:50%;height:30px;background:#5FBDF0;margin-left:25%;margin-top: 20px;border-radius:5px;line-height: 30px;color:white;text-align: center;font-weight: bold;cursor: pointer; }

.addCartSuccess{width:300px;height:auto;padding-bottom:20px;background:black;opacity:0.8;border-radius: 5px;position:absolute;top:30%;right:20%;display:none;}
.success_jx{display:inline-block;width:30%;height:30px;background:#5FBDF0;margin-left:20%;margin-top: 20px;border-radius:5px;line-height: 30px;color:white;text-align: center;font-weight: bold;cursor: pointer;}
.success_js{display:inline-block;width:30%;height:30px;background:#E19A84;margin-left:5%;margin-top: 20px;border-radius:5px;line-height: 30px;color:white;text-align: center;font-weight: bold;cursor: pointer;}
</style>
<div class="addCartFail">
	<p class="fail_info"></p>
	<span class="fail_jx">继续购买</span>
</div>  
<div class="addCartSuccess">
	<p class="success_info"></p>
	<span class="success_jx">继续购买</span>
	<span class="success_js">去结算</span>
</div> 
<script type="text/javascript">

$(function(){
	$("#quantity").change(function(){
    	var value=$(this).val();
    	var stocks="<?php echo ($goodsMess['stocks']); ?>";
    	var sales="<?php echo ($goodsMess['sales']); ?>";
    	if((stocks-sales) <= value){
    		$(this).val((stocks-sales));
    	}

    })
	var ShopCart=$("#addText");
	ShopCart.click(function(){
		var gid="<?php echo ($_GET['id']); ?>";
		var attrid=$("input[name='attrid']").val();
		var attrname=$("input[name='attrid']").val();
		var number=$("input[name='quantity']").val();
		var amount=$("input[name='amount']").val();
		$.ajax({
			 type: "POST",
             url: "/Shop/addShopCart?gid="+gid+"&time="+"<?php echo time();?>",
             data: {"gid":gid,"attrid":attrid,"attrname":attrname,"number":number,"amount":amount},
             dataType: "json",
             success: function(data){
             	if(data.status==0){
             		$(".fail_info").text(data.info);
             		$(".addCartFail").fadeIn(100)
             	}else if(data.status==1){
             		$(".no-underline").text(""+data.shopCartCount+" item")
             		$("#cart-price").text("￥"+data.amount+"");
             		$(".success_info").text(data.info);
             		$(".addCartSuccess").fadeIn(100)
             	}
             }
		})
	})
	var fail_jx=$(".fail_jx");
	var success_jx=$(".success_jx");
	var success_js=$(".success_js");
	fail_jx.click(function(){
		$(".addCartFail").fadeOut(100);
	})
	success_jx.click(function(){
		$(".addCartSuccess").fadeOut(100);
	})
	success_js.click(function(){
		window.location.href="/shop/listShopCart"
	})


})	

</script>



</body>

</html>