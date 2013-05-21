<div class="container-fluid">

	<div class="row-fluid">

		<div class="span9">

			<div class="row-fluid">
				
				<legend>Editar documento</legend>

			</div>

			<div class="row-fluid">
				
				{{ Form::open('admin/docs/edit/'.$document_type->id,'POST', array('class' => 'form-horizontal')) }}

				<div class="span6 offset3">

					<div class="control-group">

						<label class="control-label">Nombre</label>

						<div class="controls">

							<input id="document_type_description" name="document_type_description" type="text" value="{{$document_type->description}}" class="input" required="">

						</div>

					</div>

				</div>	

				<div class="span6">
				
					<!-- for further fields -->

				</div>

			</div>

			<div class="row-fluid">
			
				<div class="span2 offset5">
					
					<div class="control-group">

						<div class="controls">
						
							<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Guardar</button>
					
						</div>

					</div>
				
				</div>
			
			</div>

			{{ Form::close() }}

		</div>

		<div class="span3">
			
			<legend>Ayuda</legend>
			Informacion necesaria

		</div>

	</div>

</div>

	
	</div>

</div>