
            <main role="main" class="col-md-8 ml-sm-auto col-lg-9 px-md-4">
               <div class="box-geral m-2">
                  <h1 class="titlezada">TRABALHE COM A <?php echo name; ?></h1>
                  <div class="row">
                     <div class="col-sm">
                        <form action="#" method="post" id="trabalheConosco">
                           <h3 class="big_title">Dados Pessoais</h3>
                           <div class="row">
                              <div class="col-md-5">
                                 <div class="form-group">
                                    <label for="nome">* Nome Completo:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="nascimento">* Data de Nascimento:</label>
                                    <input type="text" name="nascimento" id="nascimento" class="form-control data" placeholder="__/__/____" required>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="email">* Endereço de E-mail:</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="celular">* Informe o seu WhatsApp (DDD) + Núm.:</label>
                                    <input type="text" name="celular" id="celular" class="form-control celular" placeholder="(__) _____-____" required>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="discord">Discord:</label>
                                    <input type="text" name="discord" id="discord" class="form-control">
                                 </div>
                              </div>
                           </div>
                           <h3 class="big_title mt-4">Informações Necessárias</h3>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="invocador">* Nome do Invocador:</label>
                                    <input type="text" name="invocador" id="invocador" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="eloatual">* Seu Elo Atual:</label>
                                    <select name="eloatual" id="eloatual" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="ferro">Ferro</option>
                                       <option value="bronze">Bronze</option>
                                       <option value="prata">Prata</option>
                                       <option value="ouro">Ouro</option>
                                       <option value="platina">Platina</option>
                                       <option value="diamante">Diamante</option>
                                       <option value="challenger">Challenger</option>
                                       <option value="grao-mestre">Grão-Mestre</option>
                                       <option value="mestre">Mestre</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="servicosfazer">* Serviços que está disposto a fazer:</label>
                                    <select name="servicosfazer" id="servicosfazer" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="elojob">Elo Boost (Elojob) / Duoboost</option>
                                       <option value="coach">Coach</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row d-none" id="box-especialidadecoach">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="especialidadecoach">* Caso tenha marcado COACH, diga a lane(s)/campeão de sua especialidade:</label>
                                    <textarea name="especialidadecoach" id="especialidadecoach" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="disponibilidadediscord">Disponibilidade para usar Discord?</label>
                                    <select name="disponibilidadediscord" id="disponibilidadediscord" class="form-control custom-select">
                                       <option value="">Selecione</option>
                                       <option value="sim">Sim</option>
                                       <option value="nao">Não</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="disponibilidadewhatsapp">* Disponibilidade para usar WhatsApp?</label>
                                    <select name="disponibilidadewhatsapp" id="disponibilidadewhatsapp" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="sim">Sim</option>
                                       <option value="nao">Não</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="suportastream">* Seu computador suporta fazer Stream?</label>
                                    <select name="suportastream" id="suportastream" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="sim">Sim</option>
                                       <option value="nao">Não</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <h3 class="big_title mt-4">Sobre Você</h3>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="qualidadebooster">* Selecione apenas uma qualidade que você mais se identifica:</label>
                                    <select name="qualidadebooster" id="qualidadebooster" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="paciente">Paciente</option>
                                       <option value="comprometido">Comprometido</option>
                                       <option value="agil">Ágil</option>
                                       <option value="compreensivo">Compreensivo</option>
                                       <option value="honesto">Honesto</option>
                                       <option value="perspicaz">Perspicaz</option>
                                       <option value="educado">Educado</option>
                                       <option value="pontual">Pontual</option>
                                       <option value="outro">Outro</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="defeitobooster">* Selecione apenas um defeito que você mais se identifica:</label>
                                    <select name="defeitobooster" id="defeitobooster" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="impaciente">Impaciente</option>
                                       <option value="preguicoso">Preguiçoso</option>
                                       <option value="nervoso">Nervoso</option>
                                       <option value="raivoso">Raivoso</option>
                                       <option value="naosabelidarcompessoas">Não sabe lidar com pessoas</option>
                                       <option value="naosabeseexpressar">Não sabe se expressar</option>
                                       <option value="desleixado">Desleixado</option>
                                       <option value="naoesocial">Não é social</option>
                                       <option value="naosabelidarcompressao">Não sabe lidar com pressão</option>
                                       <option value="outro">Outro</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="experienciabooster">* Sua experiência com Elojob, Coaching e DuoBoosting:</label>
                                    <textarea name="experienciabooster" id="experienciabooster" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="jatrabalhou">* Já trabalhou para alguma empresa de Boosting?</label>
                                    <select name="jatrabalhou" id="jatrabalhou" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="sim">Sim</option>
                                       <option value="nao">Não</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-8 d-none" id="box-motivosair">
                                 <div class="form-group">
                                    <label for="motivosair">* Se sim, CITE QUAL e o motivo de sair dela(s).</label>
                                    <textarea name="motivosair" id="motivosair" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="estimativaprazo">* Dê uma estimativa de prazo de um serviço Ouro 1 ao Platina 2, em quantos dias consegue finalizar ele? MMR normal, 20 a 25 pontos por vitória, sem pular divisão.</label>
                                    <textarea name="estimativaprazo" id="estimativaprazo" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="disponibilidadehorarios">* Disponibilidade de horários, cite quantas horas por dia você tem disponíveis para dedicar aos serviços:</label>
                                    <textarea name="disponibilidadehorarios" id="disponibilidadehorarios" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="elodispostoeloboost">* Até que elo/divisão está disposto a fazer Eloboost?</label>
                                    <textarea name="elodispostoeloboost" id="elodispostoeloboost" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="objetivoeloboost">* Com que objetivo quer fazer ELOBOOST? Qual finalidade? Você considera isso um "trabalho" de verdade?</label>
                                    <textarea name="objetivoeloboost" id="objetivoeloboost" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="sobrebooster">* Fale para nós um pouco de você e por que deveríamos te contratar?</label>
                                    <textarea name="sobrebooster" id="sobrebooster" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <h3 class="big_title mt-4">Comportamento no Jogo</h3>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="situacao1">* Leve em consideração a seguinte situação: você está em uma partida e seu time está com grande dificuldade em ganhar suas respectivas lanes. Um membro do time sai do jogo e os outros três começam a brigar e se ofender. Pergunta: O que você faria/qual atitude tomaria nessa situação?</label>
                                    <textarea name="situacao1" id="situacao1" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="situacao2">* Leve em consideração a seguinte situação: você está jogando normalmente na conta e o cliente começa a falar com você. Ele começa a pressionar você com diversas perguntas e questionar incisivamente, como, por exemplo: "pode jogar só de Ahri?"; "Tem certeza que você fez o item certo?"; "Acho que as runas que você botou não são tão boas."; O que você faria/qual atitude tomaria nessa situação?</label>
                                    <textarea name="situacao2" id="situacao2" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="situacao3">* Leve em consideração a seguinte situação: O cliente desconecta você do jogo. O que você faria/qual atitude tomaria nessa situação?</label>
                                    <textarea name="situacao3" id="situacao3" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <h3 class="big_title mt-4">Sobre a Empresa</h3>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="comoconheceu">* Como conheceu a <?php echo name; ?> -?:</label>
                                    <textarea name="comoconheceu" id="comoconheceu" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                    <p class="form-text">Caso sua resposta seja "Indicação", cite qual pessoa lhe indicou.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="polemicaeloboosting">* Muitas pessoas põem em questionamento e isso gera polêmica sobre o "EloBoosting" causar danos ao servidor. O que você pensa sobre isso?</label>
                                    <textarea name="polemicaeloboosting" id="polemicaeloboosting" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="projetoempresa">* Tem algum projeto ou ideia para acrescentar nos Serviços da <?php echo name; ?> -?</label>
                                    <textarea name="projetoempresa" id="projetoempresa" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="errojogadores">* Na sua opinião, qual principal erro atualmente dos jogadores não conseguirem subir seu Elo?</label>
                                    <textarea name="errojogadores" id="errojogadores" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="opiniaoboosting">* Qual a sua opinião sobre o Mercado de Boosting e qual principal erro das Empresas de EloBoosting no Brasil?</label>
                                    <textarea name="opiniaoboosting" id="opiniaoboosting" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="consideraempresa">* Você considera a <?php echo name; ?> - uma empresa de:</label>
                                    <textarea name="consideraempresa" id="consideraempresa" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="formulariosoutrasempresas">* Você enviou formulários para outras empresas também? ou está procurando especificamente a <?php echo name; ?> -?</label>
                                    <textarea name="formulariosoutrasempresas" id="formulariosoutrasempresas" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="trabalhoexclusivo">* Está ciente que, caso seja aceito na <?php echo name; ?> -, se compromete a trabalhar exclusivamente na Organização? Não podendo ter nenhum vínculo ou serviço em outra empresa.</label>
                                    <select name="trabalhoexclusivo" id="trabalhoexclusivo" class="form-control custom-select" required>
                                       <option value="">Selecione</option>
                                       <option value="sim">Sim, estou de acordo.</option>
                                       <option value="nao">Não concordo.</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="porqueescolheu">* Finalizando, porque escolheu a <?php echo name; ?> - para prestar serviços?</label>
                                    <textarea name="porqueescolheu" id="porqueescolheu" class="form-control" required style="width: 100%; height: 80px;"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <button type="submit" class="button-1 btn-block">Enviar</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <div class="col-lg-12 text-center text-white mt-1 mb-3">
                           <p class="m-0">Após o preenchimento do formulário, você deverá aguardar nosso contato, por isso, fique atento e relativamente ativo em seu E-mail (veja ele pelo menos uma vez por dia ou ative notificação em seu Celular).</p>
                           <p class="m-0">Não existe um prazo determinado para tais ações.</p>
                           <p class="m-0">Após isso, passará por avaliações de teste de serviços.</p>
                           <p class="m-0">Caso o resultado do Teste seja satisfatório, você será prontamente qualificado e irá ingressar na empresa. </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="overlayzada2"></div>
 
      <script src="/Template/js/mask.min.js" type="c5ebf5960e5c5e72ce38a779-text/javascript"></script>
      <script src="/Template/js/validate.js" type="c5ebf5960e5c5e72ce38a779-text/javascript"></script>
      <script type="c5ebf5960e5c5e72ce38a779-text/javascript">
         $(function() {
         	$('.data').mask('99/99/9999');
         	$('.celular').mask('(00) 00000-0000');
         	
         	$.validator.messages.required = 'Este campo é obrigatório.';
         	$.validator.messages.email = 'Por favor insira um endereço de e-mail válido.';
         	
         	$('#trabalheConosco').validate({
         		errorClass: 'text-danger border-danger'
         	});
         	
         	$('#servicosfazer').change(function() {
         		if($(this).val() == "elojob") {
         			$('#box-especialidadecoach').addClass('d-none');
         		} else {
         			$('#box-especialidadecoach').removeClass('d-none');
         		}
         	});
         	
         	$('#jatrabalhou').change(function() {
         		if($(this).val() == "nao") {
         			$('#box-motivosair').addClass('d-none');
         		} else {
         			$('#box-motivosair').removeClass('d-none');
         		}
         	});
         });
      </script>
