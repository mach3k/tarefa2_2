
			<span style="color: red;">
				<?php if(isset($erro)) {
					echo $erro;
				} ?>
			</span>
			<form method="post" action="<?php echo URL_BASE . 'admin/login.php?acao=autenticar';?>">
				<fieldset>
					<legend>Dados do usuário</legend>
					<div class="form-group">
						<label for="login">Login:</label>
						<input type="text" name="login" id="login"
						value="<?php echo isset($login) ? $login : ''; ?>">
					</div>
					<div class="form-group">
						<label for="senha">Senha:</label>
						<input type="password" name="senha" id="senha">
					</div>
					<div class="form-group">
						<button type="submit">Enviar</button>
					</div>
				</fieldset>
			</form>
		</div>
