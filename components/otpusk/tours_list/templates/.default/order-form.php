<div class="container pt-50 pb-50">
	<div class="row justify-content-center">
		<div class="col-lg-4 col-sm-6 col-lg-offset-4 col-sm-offset-3">
			<div class="h4 text-center">
				Заказ тура
			</div>
			<form action="?" method="post">
				<input type="hidden" name="order_tour">
				<input type="text" readonly	name="tour_id" class="form-control mt-10"	value="<?php echo $_GET['order_tour'] ?>">
				<input readonly name="tour_name" value="<?php echo $_GET['tour_name'] ?>" 
				type="text" class="form-control mt-10">
				<input type="email" placeholder="@ email" name="email" required class="form-control mt-10">
				<input type="text" required class="form-control mt-10" name="fio" placeholder="ФИО">
				<input type="text" required class="form-control mt-10" name="phone" placeholder="тел.">
				<button class="btn btn-primary h4 w-100 mt-10">
					<i class="fa fa-envelope-o" aria-hidden="true"></i>
					ОТПРАВИТЬ
				</button>
			</form>
		</div>
	</div>
</div>

<pre><?php print_r($_GET); ?></pre>