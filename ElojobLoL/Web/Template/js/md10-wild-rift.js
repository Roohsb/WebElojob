var modo = "boost";

function getPrecoServico(data) {
	var cupom_ativo = 1;
	var cupom_nome = "BRASIL20";
	var cupom_desconto = 20;
	
	var temporada = $('#temporada option:selected').text();
	var quantidade = $('#quantidade').val();
	
	$.ajax({
		url: 'https://elojobhigh.com.br/app/servico_preco.json',
		type: 'POST',
		dataType: 'json',
		data: 'servidor=elojoblol&servico=wildriftmd10&' + data + '&modo=' + modo,
		beforeSend: function() {
			$('#resultado').html('<div class="col-sm text-center text-white"><img src="assets/imagens/preload.png" alt="carregando..." width="55" style="margin: 0 auto;" /></div>');
		},
		success: function(data) {
			if(data.status == '1') {				
				if(cupom_ativo) {
					var valor_desconto = formatMoneyUS(data.total) - (formatMoneyUS(data.total) / 100 * cupom_desconto);
					var html = '<div class="col"><p class="price-old">DE: R$ ' + data.total + '</p>';
					html += '<p class="price">R$ ' + formatMoneyBR(valor_desconto) + '</p>';
					html += '<p class="cupom">' + cupom_desconto + '% de desconto com o cupom <strong>' + cupom_nome + '</strong> + início imediato</p></div>';
				} else {
					var html = '<div class="col price">R$ ' + data.total + '</div>';
				}
				html += '<div class="col d-flex text-right">';
				html += '	<a id="comprar" class="button-3" href="' + data.url + '">CONTRATAR</a>';
				html += '</div>';
			} else {
				var html = '<div class="alert alert-danger" role="alert">' + data.mensagem + '</div>';
			}
			$('#resultado').html(html);
		}
	});
}
$(function() {
	var elosBloqueadoDuo = ["mestre", "grao-mestre", "desafiante"];
	
	$('.modo').click(function() {
		var modo_tmp = $(this).data('value').toLowerCase();
		
		modo = modo_tmp;
		
		if(modo_tmp == "boost") {
			$('#modo-duoboost').removeClass('active');
			$('#modo-boost').addClass('active');
		} else {
			$('#modo-boost').removeClass('active');
			$('#modo-duoboost').addClass('active');
		}
		
		if(modo_tmp == 'duoboost') {
			$('#temporada option[value="mestre"], #temporada option[value="grao-mestre"], #temporada option[value="desafiante"]').hide();
			if(elosBloqueadoDuo.includes($('#temporada').val())) {
				$('#temporada').val('diamante');
				$('#form-service').submit();
			}
		} else {
			$('#temporada option[value="mestre"], #temporada option[value="grao-mestre"], #temporada option[value="desafiante"]').show();
		}
		
		$('#form-service').submit();
	});
	$('#temporada, #quantidade').change(function() {
		$('#form-service').submit();
	});	
	$('#form-service').submit(function() {
		getPrecoServico($(this).serialize());
		return false;
	}).submit();
});