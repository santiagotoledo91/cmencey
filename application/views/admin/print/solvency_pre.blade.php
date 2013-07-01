@layout('layouts.admin')
@section('content')
<div class="container-fluid">

	<div class="row-fluid">

		<div class="span10 offset1">

			<div class="row-fluid span6 offset3">

				<h4 class="text-center">Generar solvencia</h4>
				<div class="space1"></div>
			
			</div>

			<div class="row-fluid">

				{{ Form::open('admin/print/solvency2','POST', array('class' => 'form-horizontal')) }}

				<div class="span6 offset3">

					<div class="white-area white-area-content">
						
						<div class="control-group">

							<label class="control-label">Concepto</label>

							<div class="controls">

								<select id="solvency_concept" name="solvency_concept" class="input-medium">
									<option value="sso">SSO</option>
									<option value="inces">INCES</option>
									<option value="faov">FAOV</option>
									<option value="forced_stop">Paro Forzoso</option>
								</select>

							</div>

						</div>

						<div class="control-group">

							<label class="control-label">Período de pago</label>

							<div class="controls">	

								<select id="solvency_startdate" name="solvency_startdate" class="input-medium">
									<option select="selected">Desde</option>
									@foreach ($paysheets as $paysheet)
										<option value="{{$paysheet->startdate}}">{{$paysheet->startdate}}</option>
									@endforeach
								</select>
								
								- 
								
								<select id="solvency_stopdate" name="solvency_stopdate" class="input-medium">
									<option select="selected">Hasta</option>
									@foreach ($paysheets as $paysheet)
										<option value="{{$paysheet->stopdate}}">{{$paysheet->stopdate}}</option>
									@endforeach
								</select>
								
							</div>

						</div>

					</div>

				</div>	

			</div>

			<div class="row-fluid">

				<div class="span2 offset5">

					<div class="control-group">

						<div class="controls">

							<div class="space1"></div>

							<button id="submit" name="submit" class="btn btn-primary btn-block"><i class="icon-ok icon-white"></i> Generar</button>

						</div>

					</div>

				</div>

			</div>

			{{ Form::close() }}

		</div>

	</div>

</div>

@endsection