
<style>
	.modal-title{
		font-size: 24px;
		color: #0f0f3d;
	}
	.fa-plus{
		color: #fff;
	}
	#text_lembrarSenha{
		font-size: 13px;
		color: #595959;
	}
	.form-control-placeholder{
		color: #595959;
	}
	.fa-times-circle:hover{
		color: #cc2900;
	}


</style>

<section style="min-height: calc(100vh - 83px)" class="bg-light">
		
	<div class="container">
		<div class="row">
			<div class="offset-3 col-lg-6 text-center">
				<div class="section-title">
					<br/><br/>
					<h2>ÁREA RESTRITA</h2>
					
				</div>
			</div>
		</div>

		<br/>

		<div class="row">
			<div class="offset-5 col-lg-2 text-center">
				<div class="form-group"> <!-- atributo criado para o usuario |sessao |dados -->
					<a id="btn_your_user" class="btn btn-link" user_id="<?=$user_id?>"><i class="fa fa-user fa-2x"></i></a>
					<a class="btn btn-link" href="restrict/logoff"><i class="fa fa-sign-out fa-2x"></i></a>
				</div>
			</div>
		</div>

		<br/><br/>

		<div class="container">
			<ul class="nav nav-tabs">
				<li class="nav-item"><a href="#tab_courses" class="nav-link active" role="tab" data-toggle="tab">Cursos</a></li>
				<li class="nav-item"><a href="#tab_team" class="nav-link" role="tab" data-toggle="tab">Equipe</a></li>
				<li class="nav-item"><a href="#tab_user" class="nav-link" role="tab" data-toggle="tab">Usuários</a></li>
			</ul>

			<div class="tab-content">
				<div id="tab_courses" class="tab-pane active">
					<div class="container-fluid">
						<br/>
						<h2 class="text-center"><br/><strong>Gerenciar Cursos</strong></h2>
						<a id="btn_add_course" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar Curso</i>
						</a>
						<table id="dt_courses" class="table table-striped table-bordered">
							<thead>
								<tr class="tableheader">
									<th class="dt-center">Nome</th>
									<th class="dt-center no-sort">Imagem</th>
									<th class="dt-center">Duração</th>
									<th class="no-sort">Descrição</th>
									<th class="dt-center no-sort">Ações</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div id="tab_team" class="tab-pane">
					<div class="container-fluid">
						<br/>
						<h2 class="text-center"><br/><strong>Gerenciar Equipe</strong></h2>
						<a id="btn_add_member" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar Equipe</i></a>
						<table id="dt_team" class="table table-striped table-bordered">
							<thead>
								<tr class="tableheader">
									<th class="dt-center">Nome</th>
									<th class="dt-center no-sort">Foto</th>
									<th class="no-sort">Descrição</th>
									<th class="dt-center no-sort">Ações</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>

				<div id="tab_user" class="tab-pane">
					<div class="container-fluid">
						<br/>
						<h2 class="text-center"><br/><strong>Gerenciar Usuários</strong></h2>
						<a id="btn_add_user" class="btn btn-primary"><i class="fa fa-plus">&nbsp;&nbsp;Adicionar Usuário</i></a>
						<table id="dt_users" class="table table-striped table-bordered">
							<thead>
								<tr class="tableheader">
									<th>Login</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th class="dt-center no-sort">Ações</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	
	</div>
		
</section>

<!-- MODAL CURSO -->
<!-- Modais (seminor-login-modal) -->
  <div class="modal fade" data-backdrop="static" id="modal_course">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal HEADER -->
        <div class="modal-body seminor-login-modal-body">
        	<h5 class="modal-title text-center">ADICIONAR CURSO</h5><br/>
		    <button type="button" class="close" data-dismiss="modal">
		        <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
		    </button>


    		<form id="form_course">
    			<input id="course_id" name="course_id" hidden>
    			
      			<div class="form-group">
      				<label class="form-control-placeholder" for="name">Nome do Curso</label>
        			<input name="course_name" id="course_name" class="form-control" maxlength="100">
        			<span class="help-block"></span>
      			</div>

      			<div class="form-group">
      				<label class="form-control-placeholder" for="photo">Imagem</label>
	      			<img src="" id="course_img_path" style="max-height: 400px; max-width: 400px">
	      			<label class="btn btn-block btn-info">
	      				<i class="fa fa-upload"></i>&nbsp;&nbsp;Importar imagem
	      				<input type="file" id="btn_upload_course_img" accept="image/*" style="display: none;">
	      			</label>
	      			<input id="course_img" name="course_img" hidden>
	      			<span class="help-block"></span>
		      	</div>

		      	<div class="form-group">
		      		<label class="form-control-placeholder" for="photo">Duração do Curso (h)</label>
			        <input type="number" step="0.1" class="form-control" id="course_duration" name="course_duration">
		      	</div>

		      	<div class="form-group">
		      		<label class="form-control-placeholder" for="photo">Descrição do Curso</label>
			        <textarea type="text" class="form-control" id="course_description" name="course_description">
			        </textarea>
		      	</div>

      			<!--<div class="form-group">
		        	<label class="container-checkbox">
			        	<b id="text_lembrarSenha">Lembrar-me neste computador</b>
			        	<input type="checkbox" checked="checked" required>
			        	<span class="checkmark-box"></span>
		        	</label>
		        </div>-->

		        <div class="btn-check-log">
		            <button type="submit" id="btn_save_course" class="btn btn-primary">
		            	<i class="fa fa-save"></i>&nbsp;&nbsp;SALVAR
		            </button>
		            <span class="help-block"></span>
		        </div>

       			<!--<div class="forgot-pass-fau text-center pt-3">
             		<a href="/reset_pass" class="text-secondary">Esqueceu sua senha?</a>
	            </div>

	           	<div class="create-new-fau text-center pt-3">
	            	<a href="#" class="text-primary-fau"><span data-toggle="modal" data-target="#sem-reg" data-dismiss="modal">Criar uma nova conta</span></a>
	           	</div>-->

	      	</form>

        </div>
      </div>
    </div>
  </div>

<!-- MODAL MEMBRO -->

<div class="modal fade" data-backdrop="static" id="modal_member">
    <div class="modal-dialog modal-dialog-centered">
      	<div class="modal-content">

	        <!-- Modal HEADER -->
	        <div class="modal-body seminor-login-modal-body">
	        	<h5 class="modal-title text-center">ADICIONAR MEMBRO</h5><br/>
			    <button type="button" class="close" data-dismiss="modal">
			        <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
			    </button>

	    		<form id="form_member">
	    			<input id="member_id" name="member_id" hidden>

	      			<div class="form-group">
	      				<label class="form-control-placeholder" for="name">Nome</label>
	        			<input name="member_name" id="member_name" class="form-control" maxlength="100" required autocomplete="off">
	        			<span class="help-block"></span>
	      			</div>

	      			<div class="form-group">
      				<label class="form-control-placeholder" for="photo">Foto</label>
     
      				<img src="" id="member_photo_path" style="max-height: 400px; max-width: 400px">
      				<label class="btn btn-block btn-info">
      					<i class="fa fa-upload"></i>&nbsp;&nbsp;Importar foto
      					<input type="file" id="btn_upload_member_photo" accept="image/*" style="display: none;">
      				</label>
      				<input id="member_photo" name="member_photo" hidden>
      				<span class="help-block"></span>
		      	</div>

			      	<div class="form-group">
				      	<label class="form-control-placeholder" for="photo">Descrição</label>
					    <textarea type="text" class="form-control" id="member_description" name="member_description"></textarea>
			      	</div>

			        <div class="btn-check-log">
			            <button type="submit" id="btn_save_member" class="btn btn-primary">
			            	<i class="fa fa-save"></i>&nbsp;&nbsp;SALVAR
			            </button>
			            <span class="help-block"></span>
			        </div>
		      	</form>

	        </div>
    	</div>
	</div>
</div>


<!-- MODAL DE USUÁRIOS DE DRUGS -->

<div class="modal fade" data-backdrop="static" id="modal_user">
    <div class="modal-dialog modal-dialog-centered">
      	<div class="modal-content">

	        <!-- Modal HEADER -->
	        <div class="modal-body seminor-login-modal-body">
	        	<h5 class="modal-title text-center">ADICIONAR USUÁRIO</h5><br/>
			    <button type="button" class="close" data-dismiss="modal">
			        <span><i class="fa fa-times-circle" aria-hidden="true"></i></span>
			    </button>


	    		<form id="form_user">
	    			<input id="user_id" name="user_id" hidden>

	      			<div class="form-group">
	      				<label class="form-control-placeholder" for="name">Login</label>
	        			<input name="user_login" id="user_login" class="form-control" maxlength="30" required autocomplete="off">
	        			<span class="help-block"></span>
	      			</div>

	      			<div class="form-group">
	      				<label class="form-control-placeholder">Nome completo</label>
				        <input class="form-control" id="user_full_name" name="user_full_name" maxlength="100" required autocomplete="off">
			      	</div>

					<div class="form-group">
	      				<label class="form-control-placeholder">E-mail</label>
				        <input class="form-control" id="user_email" name="user_email" maxlength="100" required autocomplete="off">
			      	</div>

			      	<div class="form-group">
	      				<label class="form-control-placeholder">Confirmar E-mail</label>
				        <input class="form-control" id="user_email_confirm" name="user_email_confirm" maxlength="100" required autocomplete="off">
			      	</div>

			      	<div class="form-group">
	      				<label class="form-control-placeholder">Senha</label>
				        <input type="password" class="form-control" id="user_password" name="user_password" maxlength="100" required autocomplete="off">
			      	</div>

			      	<div class="form-group">
	      				<label class="form-control-placeholder">Confirmar Senha</label>
				        <input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm" maxlength="100" required autocomplete="off">
			      	</div>   	

			        <div class="btn-check-log">
			            <button type="submit" id="btn_save_user" class="btn btn-primary">
			            	<i class="fa fa-save"></i>&nbsp;&nbsp;SALVAR
			            </button>
			            <span class="help-block"></span>
			        </div>
		      	</form>

	        </div>
    	</div>
	</div>
</div>