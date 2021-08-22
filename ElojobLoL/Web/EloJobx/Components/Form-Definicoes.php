            <fieldset>
            <legend>Informações</legend>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="avatarDefinicoes">Avatar</label>
                              <div class="col-md-8">
                                 <div id="avatar-definicoes-imagem"></div>
                                 <select name="avatar" id="avatarDefinicoes" class="form-control">
                                 <?php 
                                 AvatarSelect($Server,GetDateUser($Server)[1]["avatar"]);
                                 ?>
                                   
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="capaDefinicoes">Capa</label>
                              <div class="col-md-8">
                                 <div id="capa-definicoes-imagem"></div>
                                 <select name="capa" id="capaDefinicoes" class="form-control">
                                   
                                <?php BannerSelect($Server,GetDateUser($Server)[1]["banner"]); 
                                 echo '</select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label">Usuário</label>
                              <div class="col-md-8">
                                 <p class="form-control-static">'.$_SESSION["Usuario"].'</p>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="nome">Nome</label>
                              <div class="col-md-8">
                                 <input type="text" name="nome" id="nome" class="form-control" value="'.GetDateUser($Server)[0]["nome"].'"> 
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="celular">Celular</label>
                              <div class="col-md-8">
                                 <input type="text" name="celular" id="celular" class="form-control phone" value="'.GetDateUser($Server)[0]["celular"].'" placeholder="(__) _____-____">
                                 <span class="help-block">Caso possua, cadastre um celular com WhatsApp.</span>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="email">E-mail</label>
                              <div class="col-md-8">
                                 <p class="form-control-static">'.GetDateUser($Server)[0]["email"].'</p>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-4 control-label" for="notificacoes">Notificações por e-mail</label>
                              <div class="col-md-8">
                                 <label class="switch switch-primary">
                                 <input type="checkbox" name="notificacoes" id="notificacoes" value="1" checked="checked">
                                 <span></span>
                                 </label>
                              </div>
                           </div>'; ?>
                        </fieldset>