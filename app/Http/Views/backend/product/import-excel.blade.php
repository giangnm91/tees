<div class="modal fade" id="modal-import-excel">
	<div class="modal-dialog">
		<div class="modal-content">
			 {!! Form::open(array('id' => 'form-import-excel',
			 	'files' => true,'class' => 'form-horizontal')) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Import Excel</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-center margin-top-10">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn green btn-file">
                                <span class="fileinput-new"> Select file </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="file" name="file" id="input-import-excel"> </span>
                            <span class="fileinput-filename"> </span> &nbsp;
                            <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                        </div>
                    </div>
				</div>
				<div class="row margin-top-5">
					<table id="table-preview-excel"></table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Import</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>