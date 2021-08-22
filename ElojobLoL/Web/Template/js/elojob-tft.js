function getPrecoServico(data) {
	var cupom_ativo = 1;
	var cupom_nome = "BRASIL20";
	var cupom_desconto = 20;
	
	var base_img = 'assets/imagens/badges/';
	
	var elosSemDivisao = ["mestre", "grao-mestre", "desafiante"];
	
	var ligaatual = $('#ligaatual').val();
	var divisaoatual = $('#divisaoatual').val();
	var ligadesejada = $('#ligadesejada').val();
	var divisaodesejada = $('#divisaodesejada').val();
	
	var ligaatual_ = $('#ligaatual option:selected').text();
	var divisaoatual_ = $('#divisaoatual option:selected').text();
	var ligadesejada_ = $('#ligadesejada option:selected').text();
	var divisaodesejada_ = $('#divisaodesejada option:selected').text();
	
	if(elosSemDivisao.includes(ligaatual)) {
		var nomeEloAtual = ligaatual_;
		var currentImage = ligaatual + '.png';
		$('#divisaoatual').hide();
	} else {
		var nomeEloAtual = ligaatual_ + ' ' + divisaoatual_;
		var currentImage = ligaatual + '_' + divisaoatual + '.png';
		$('#divisaoatual').show();
	}
	
	if(elosSemDivisao.includes(ligadesejada)) {
		var nomeEloDesejado = ligadesejada_;
		var desiredImage = ligadesejada + '.png';
		$('#divisaodesejada').hide();
	} else {
		var nomeEloDesejado = ligadesejada_ + ' ' + divisaodesejada_;
		var desiredImage = ligadesejada + '_' + divisaodesejada + '.png';
		$('#divisaodesejada').show();
	}
		
	$('#current-image').attr('src', base_img + currentImage);
	$('#desired-image').attr('src', base_img + desiredImage);
	
	$.ajax({
		url: 'https://elojobhigh.com.br/app/servico_preco.json',
		type: 'POST',
		dataType: 'json',
		data: 'servidor=elojoblol&servico=tftelojob&' + data,
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
	$('#ligaatual, #ligadesejada, #divisaoatual, #divisaodesejada').change(function() {
		$('#form-service').submit();
	});
	$('#form-service').submit(function() {
		getPrecoServico($(this).serialize());
		return false;
	}).submit();
});