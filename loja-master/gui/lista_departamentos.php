
			<table>
				<thead>
					<tr>
						<th>Código</th><th>Nome</th><th>Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($registros as $registro)
						{
							echo "
								<tr>
									<td>" . $registro['id'] . "</td>
									<td>{$registro['nome']}</td>
									<td class='acoes'>
										<a href='" . URL_BASE . "admin/departamentos.php?acao=alterar&id={$registro['id']}'>A</a>&nbsp;&nbsp;
										<a href='javascript:if(confirm(\"Confirma a exclusão?\")){document.location=\"" . URL_BASE . "admin/departamentos.php?acao=excluir&id={$registro['id']}\";}'>E</a>
									</td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
			<div class="form-group"><button type="button" onclick="document.location='<?=URL_BASE;?>admin/departamentos.php?acao=incluir';">Novo</button><button onclick="document.location='<?php echo URL_BASE; ?>admin/';">Voltar</button></div>
		</div><!-- container -->