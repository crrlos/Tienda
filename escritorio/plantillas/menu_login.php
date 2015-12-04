<div id="login">
				<a href="#" id="showlogin">
					Entrar
					<span id="triangle_down">&#9660;</span>
					<span id="triangle_up" style="display:none;">&#9650;</span>	
				</a>
						
				<div id="loginpanel" style="display:none;">
					<form action="http://www.impuso2015.tk/controladores/controladorUsuarios.php" method="post">
                                            <input type="hidden" name="opusuario" value="1">
						Usuario<input type="text" id="username" name="usuario" />
						Contraseña<input type="password" id="password" name="clave" />
                                                <a href="/registro">Registrarse</a><br>
                                                <a href="/forgot">¿Olvidó su contraseña?</a>
						<button type="submit" id="submit">Entrar</button>
                                              
					</form>
				</div>
			</div>