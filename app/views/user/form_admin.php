<!-- NOTA: validar id debe ser entero -->
<form class="form-horizontal" role="form" action="./login.php" method="post"><br><br>
  <fieldset>
    
    <div class="form-group">
      <label for="inputName" class="col-lg-3 control-label">Identificaci&oacute;n</label>
      <div class="col-lg-9">
        <input type="name" class="form-control field-admin-form" name="cc" id="form-admin-id" placeholder="Identificaci&oacute;n">
      </div>
    </div>
    
    <div class="form-group pwd-login-box">
      <label for="inputComment" class="col-lg-3 control-label">Nombre</label>
      <div class="col-lg-9">
        <input type="name" class="form-control field-admin-form" name="pwd" id="form-admin-name" placeholder="Nombre">
      </div>
    </div>
    
    <div class="form-group pwd-login-box">
      <label for="inputComment" class="col-lg-3 control-label">Apellido</label>
      <div class="col-lg-9">
        <input type="name" class="form-control field-admin-form" name="surname" id="form-admin-surname" placeholder="Apellido">
      </div>
    </div>
    
    <div class="form-group pwd-login-box">
      <label for="inputComment" class="col-lg-3 control-label">Correo</label>
      <div class="col-lg-9">
        <input type="name" class="form-control field-admin-form" name="correo" id="form-admin-email" placeholder="Correo electr&oacute;nico">
      </div>
    </div>
    
    <div class="form-group pwd-login-box">
      <label for="inputComment" class="col-lg-3 control-label">Contrase&ntilde;a</label>
      <div class="col-lg-9">
        <input type="password" class="form-control field-admin-form" name="pwd" id="form-admin-pwd" placeholder="Contrase&ntilde;a">
      </div>
    </div>
    
    <div class="form-group pwd-login-box">
      <label for="inputComment" class="col-lg-3 control-label">Dependencia</label>
      <div class="col-lg-9">
        <select class="form-control field-admin-form" id="form-admin-module">
          <option value="admisiones">Admisiones</option>
          <option value="caja">Caja</option>
          <option value="certificados">Certificados</option>
          <option value="cartera">Cartera</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-lg-offset-3 col-lg-9">
        <button type="button" class="btn btn-primary" id="register-admin">Registrar operario</button>
        <button type="button" class="btn btn-default" id="admin-clean">Limpiar</button>
      </div>
    </div>
  </fieldset>
</form>