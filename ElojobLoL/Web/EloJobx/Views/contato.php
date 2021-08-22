
            <main role="main" class="col-md-8 ml-sm-auto col-lg-9 px-md-4">
               <div class="box-geral m-2">
                  <div class="row">
                     <div class="col">
                        <h1 class="titlezada mb-4">CONTATO</h1>
                        <div class="text-white form-group">
                           <form action="#" method="post" id="contato" class="d-flex flex-column contato-form">
                              <p>Nome</p>
                              <input name="nome" class="form-control mb-3" required>
                              <p>E-mail</p>
                              <input name="email" type="email" class="form-control mb-3" required>
                              <p>Celular</p>
                              <input name="celular" type="text" class="form-control celular mb-3" placeholder="(__) _____-____" required>
                              <p>Mensagem</p>
                              <textarea name="mensagem" class="form-control" required></textarea>
                              <button class="mt-3 button-3" type="submit">Enviar</button>
                           </form>
                        </div>
                        <div class="mt-5 p-3 div2">
                           <h3>Outras formas de contato</h3>
                           <p class="m-0">WhatsApp - <a href="<?php echo whatsapplink; ?>" target="_blank" class="link-hover" style="text-decoration: underline;"><?php echo whatsapp; ?></a></p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="overlayzada2"></div>
            </main>
    
      <script src="/Template/js/mask.min.js" type="ff2b2e2b66cb38bb55c4b4d1-text/javascript"></script>
      <script src="/Template/js/validate.js" type="ff2b2e2b66cb38bb55c4b4d1-text/javascript"></script>
      <script type="ff2b2e2b66cb38bb55c4b4d1-text/javascript">
         $(function() {
         	$('.celular').mask('(00) 00000-0000');
         	
         	$.validator.messages.required = 'Este campo é obrigatório.';
         	$.validator.messages.email = 'Por favor insira um endereço de e-mail válido.';
         	
         	$('#contato').validate({
         		errorClass: 'text-danger border-danger'
         	});
         });
      </script>
   