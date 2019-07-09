	<div class="form-group">
				<table id="myTable">
					<tbody id="row">
					<tr>
						<td>
							<div class="form-inline">
								<div class="form-group mr-2">
									@if(count($products))
									<select class="form-control" name="products[]">
										<option value="">Select a product</option>
										@foreach($products as $product)
										<option value="{{$product->id}}">{{$product->name}}</option>
										@endforeach
									</select>
									@endif
								</div>
								<div class="form-group mr-2">
									<input type="text" class="form-control" name="original[]" placeholder="Original Price">
								</div>
								<div class="form-group mr-2">
									<input type="text" class="form-control" name="selling[]" placeholder="Selling Price">
								</div>
								<div class="form-group mr-2">
									<input type="text" class="form-control" name="quantity[]" placeholder="Quantity">
								</div>
							</div>
						</td>
					</tr>
					</tbody>
					
				</table>
			</div>

			<div class="form-group float-right">
				<input type="submit" value="Submit"  class="btn btn-primary ">
			</div>
		</form>
		<div class="form-group float-left"><button id="addRow" class="btn btn-default mr-2"><i class="fa fa-plus"></i></button><button class="btn btn-default" id="removeRow"><i class="fa fa-minus"></i></button></div>

		<script type="text/javascript">
	var i = 0;
	$('#addRow').click(function(e){
		e.preventDefault();
		i++;
		var row = '<tr id="row'+i+'">'+
		'<td>'+
		'<div class="form-inline">'+
			'@if(count($products))'+
			'<div class="form-group mr-2">'+
			
					'<select class="form-control mr-2" name="products[]">'+
					'<option value="">Select a product</option>'+
					'@foreach($products as $product)'+
					'<option value="{{$product->id}}">{{$product->name}}</option>'+
					'@endforeach'+
				'@endif'+
			'</div>'+

			'<div class="form-group mr-2">'+
				'<input type="text" class="form-control" name="original[]" placeholder="Original Price">'+
			'</div>'+
			'<div class="form-group mr-2">'+
				'<input type="text" class="form-control" name="selling[]" placeholder="Selling Price">'+
			'</div>'+
			'<div class="form-group mr-2">'+
				'<input type="text" class="form-control" name="quantity[]" placeholder="Quantity">'+
			'</div>'+

		'</div>'+
		'</td>'+
		'</tr>';

		$('#row').append(row);
	});
	$('#removeRow').click(function(e){
		e.preventDefault();
		$('#row').find('#row'+i).remove();
		i--;
	});
</script>