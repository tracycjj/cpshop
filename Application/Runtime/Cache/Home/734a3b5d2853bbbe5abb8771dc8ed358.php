<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0">

    <title>购物车结算</title>

<link href="/Public/home/css/style.scss.css" rel="stylesheet" type="text/css" media="all">
	<link rel="stylesheet" media="all" href="/Public/home/css/additional-checkout-buttons-e666b0b8a20c90d1eaafcc0f38897f2b4ab8af21f68426b37926e48a2ae452c2.css">
	<link rel="stylesheet" media="all" href="/Public/home/css/makeorder.css">
		<script type="text/javascript" src="/Public/home/js/jquery.js"></script>

</head>
  <body>



    <div class="content" data-content="">
      <div class="wrap">
        <div class="sidebar" role="complementary">
          <div class="sidebar__content">
            <div class="order-summary order-summary--is-collapsed" data-order-summary="">

				  <div class="order-summary__sections">
				    <div class="order-summary__section order-summary__section--product-list">
					  <div class="order-summary__section__content">
					    <table class="product-table">
					      <tbody data-order-summary-section="line-items">
					<?php if(is_array($shopCartList)): foreach($shopCartList as $key=>$sc): ?><tr class="product" >
					          <td class="product__image">
					            <div class="product-thumbnail">
								  <div class="product-thumbnail__wrapper">
								    <img alt="<?php echo ($sc["name"]); ?>" class="product-thumbnail__image" src="<?php echo ($sc["picimg"]); ?>">
								  </div>
								    <span class="product-thumbnail__quantity" aria-hidden="true"><?php echo ($sc["number"]); ?></span>
								</div>
					          </td>
					          <td class="product__description">
					            <span class="product__description__name order-summary__emphasis"><?php echo ($sc["name"]); ?></span>
					            <span class="product__description__variant order-summary__small-text"></span>

					          </td>
					          <td class="product__quantity visually-hidden">
					            1
					          </td>
					          <td class="product__price">
					            <span class="order-summary__emphasis">￥<?php echo ($sc["amount"]); ?></span>
					          </td>
					</tr><?php endforeach; endif; ?>

					      </tbody>
					    </table>
					  </div>
					</div>

				<div class="order-summary__section order-summary__section--total-lines" data-order-summary-section="payment-lines">
				  <table class="total-line-table">
				      <tbody class="total-line-table__tbody">
				        <tr class="total-line total-line--subtotal">
				          <td class="total-line__name">商品总价</td>
				          <td class="total-line__price">
				            <span class="order-summary__emphasis">
				              ￥<?php echo ($allAmount); ?>
				            </span>
				          </td>
				        </tr>

				          <tr class="total-line total-line--shipping">
				            <td class="total-line__name">邮费</td>
				            <td class="total-line__price">
				              <span class="order-summary__emphasis" data-checkout-total-shipping-target="0">
				                 <?php if($shopSet['postage']): ?>￥<?php echo ($shopSet['postage']); else: ?>免邮<?php endif; ?>
				              </span>
				             

				            </td>
				          </tr>
				      </tbody>
				    <tfoot class="total-line-table__footer">
				      <tr class="total-line">
				        <td class="total-line__name payment-due-label">
				          <span class="payment-due-label__total">总共支付</span>
				        </td>
				        <td class="total-line__price payment-due">
				          <span class="payment-due__price" data-checkout-payment-due-target="3299">
				             ￥<?php echo ($allAmount+$shopSet['postage']); ?>
				          </span>
				        </td>
				      </tr>
				    </tfoot>
				  </table>
				</div>
					<button type="submit" onclick="subOrder(this)" class="field__input-btn btn btn--default btn--disabled" style="fwidth:100%;margin:1px 1px;">
			          <span class="btn__content visually-hidden-on-mobile">结算</span>
			          <i class="btn__content shown-on-mobile icon icon--arrow"></i>
			          <i class="btn__spinner icon icon--button-spinner"></i>
			        </button>


				  </div>
				</div>

	      </div>
    </div>

        <div class="main" role="main">
          <div class="main__header">
            <ul class="breadcrumb ">
			    <li class="breadcrumb__item breadcrumb__item--completed">
			      <a class="breadcrumb__link" href="<?php echo U(Shop/cartList);?>">购物车</a>
			    </li>

			    <li class="breadcrumb__item breadcrumb__item--current">
			      填写订单信息
			    </li>
			    <li class="breadcrumb__item breadcrumb__item--blank">
			      订单结算
			    </li>
			</ul>

            
          </div>
          <div class="main__content">
            <div class="step" data-step="contact_information">
  <form novalidate="novalidate"  accept-charset="UTF-8" method="post">


  <div class="step__sections">
   


  <div class="section section--shipping-address" data-shipping-address="" data-update-order-summary="">
	
	
	<div class="field--half field field--required" style="display:none;">
	  <div class="field__input-wrapper">
	  <label class="field__label" for="checkout_shipping_address_first_name">选择地址</label>
		 <div style="width:100%;height:40px;border:0px solid red;">
			<select style="width:100%;height:38px;border:1px solid #dedede;"></select>
		</div>
	  </div>
	</div>

    <div class="section__content">
      <div class="fieldset" data-address-fields="">

		<div class="field--half field field--required">
		  <div class="field__input-wrapper"><label class="field__label" for="checkout_shipping_address_first_name">收货人</label>
		    <input placeholder="收货人"  class="field__input"  type="text" name="username" id="checkout_shipping_address_first_name">
		  </div>
		</div>
		<div class="field--half field field--required">
		  <div class="field__input-wrapper"><label class="field__label" for="checkout_shipping_address_first_name">联系电话</label>
		    <input placeholder="联系电话"  class="field__input"  type="text" name="phone" id="checkout_shipping_address_first_name">
		  </div>
		</div>
		<div class="field--half field field--required">
		  <div class="field__input-wrapper"><label class="field__label" for="checkout_shipping_address_first_name">详细地址</label>
		    <input placeholder="详细地址"  class="field__input"  type="text" name="address" id="checkout_shipping_address_first_name">
		  </div>
		</div>
		<div class="field--half field field--required">
		  <div class="field__input-wrapper"><label class="field__label" for="checkout_shipping_address_first_name">留言</label>
		    <textarea class="field__input" name="note" style="border:1px solid #dedede;height:100px;"></textarea>
		</div>
		<div class="field--half field field--required">
		  <div class="field__input-wrapper"><label class="field__label" for="checkout_shipping_address_first_name">贺卡内容</label>
		    <textarea class="field__input" name="giftnote" style="border:1px solid #dedede;height:100px;"></textarea>
		</div>
		<div class="field--half field field--required">
		  <div class="field__input-wrapper"><label class="field__label" for="checkout_shipping_address_first_name">支付方式</label>
		  <!--   <input  type="radio" name="payment" style="width:20px;height:20px;" />支付宝
		  <input  type="radio" name="payment"  style="width:20px;height:20px;"/>微信 -->
		<p>  <a href="javascript:void(0);" onclick="payment(1,this)" class="field__input-btn btn btn--default" style="height:30px;line-height:0px;background:#5bc0de;color:white;border:1px solid red;">支付宝</a>
		  <a href="javascript:void(0);" onclick="payment(2,this)" class="field__input-btn btn btn--default" style="height:30px;line-height:0px;background:#e4e4e4;color:black;">微信</a>
		</p>
		  <input  type="hidden" name="payment" value="1"/>
		  </div>
		  <script type="text/javascript">
		  function payment(type,obj){
		  	$(obj).css({"background":'#5bc0de',"color":'#e4e4e4',"border":"1px solid red"}).siblings().css({"background":'#e4e4e4',"color":'black',"border":"0"});
		  	$("input[name='payment']").val(type);
		  }
		  </script>
		</div>

      </div> 
    </div> 
  </div> 


  </div>

  
<style type="text/css">
@media screen and (max-width: 640px){
	.step__footer{display:block;}
}
@media screen and (min-width: 640px){
	.step__footer{display:none;}
}
.payment{    color: #fff;
    background-color: #428bca;
    border-color: #357ebd;}
</style>
<div class="step__footer">
    <button name="button" type="submit" class="step__footer__continue-btn btn ">
	  <span class="btn__content">结算</span>
	  <i class="btn__spinner icon icon--button-spinner"></i>
	</button>
  	<a class="step__footer__previous-link" href="<?php echo U('Shop/listShopCart');?>">返回购物车</a>
</div>

</form>

</div>

</div>


  </div>
</div>

<style type="text/css">
	.alertbox{width:200px;height:40px;text-align: center;line-height: 40px;border-radius:5px;background:black;color:white;position:absolute;top:40%;left:50%;display:none;}
	.boxzc{width:100%;height: 100%;background:white;position:absolute;z-index: 100;top:0;left:0;opacity:0;display:none;}
</style>
<div class="boxzc"></div>
<div class="alertbox">
	修改失败
</div>
<script type="text/javascript">
function alertbox(text){
	$(".alertbox").text(text);
	$(".alertbox").fadeIn(100);
	setTimeout(function(){
		$(".alertbox").fadeOut(100);
	},2000)
}
function subOrder(obj){
	var username=$("input[name='username']").val();
	var phone=$("input[name='phone']").val();
	var address=$("input[name='address']").val();
	var note=$("textarea[name='note']").val();
	var giftnote=$("textarea[name='giftnote']").val();
	var payment=$("input[name='payment']").val();
	if(!username){
		alertbox("请填写收货人姓名!");
	}
	if(!/^1[3,5,8,7][0-9]{9}$/.test(phone)){
		alertbox("请正确填写收货人电话!");return false;
	}
	if(!address){
		alertbox("请填写收货地址!");return false;
	}
	if(!payment){
		alertbox("请填写支付方式!");return false;
	}
	$(".boxzc").css("display","block");
	$(obj).find("span").text("正在生成订单....");

	$.ajax({
			 type: "post",
             url: "/Shop/makeOrder",
             data: {"username":username,"phone":phone,"address":address,"note":note,"giftnote":giftnote,"payment":payment},
             dataType: "json",
             success: function(data){
             	if(data.status==0){
             		alertbox(data.info);
             		$(obj).find("span").text("结算");
             		$(".boxzc").css("display","none");
             	}else if(data.status==1){
             		alertbox(data.info);
             		window.location.href="/Shop/orderPay?orderid="+data.orderid+"&time="+"<?php echo time();?>";
             	}
             }
		})
}	
</script>
    
    
    
  

</body></html>