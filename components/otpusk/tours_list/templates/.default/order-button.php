<div class="pt-5">
	<form action="" method="get">
		<button 
		name="order_tour" 
		value="<?php echo $order_tour['ID'];?>" 
		class="btn btn-primary">
		Оставить заявку
	</button>
	<input type="hidden" name="tour_name" value="<?php echo $order_tour['NAME'];?>">
</form>
</div>