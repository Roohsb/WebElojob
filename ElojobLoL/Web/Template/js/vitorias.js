var fila = "solo/duo";

function getPrecoServico(data) {
	var cupom_ativo = 1;
	var cupom_nome = "BRASIL20";
	var cupom_desconto = 20;
	
	var ligaatual = $('#ligaatual').val();
	var quantidade = $('#quantidade').val();
	var base_img = 'assets/imagens/badges/';
	var elosSemDivisao = ["mestre", "grao-mestre", "desafiante"];
	
	var ligaatual_ = $('#ligaatual option:selected').text();
	var divisaoatual_ = $('#divisaoatual option:selected').text();
	
	if(elosSemDivisao.includes(ligaatual)) {
		var nomeEloAtual = ligaatual_;
		var currentImage = ligaatual + '.png';
		$('#divisaoatual').hide();
	} else {
		var nomeEloAtual = ligaatual_ + ' ' + divisaoatual_;
		var currentImage = ligaatual + '_' + $('#divisaoatual').val() + '.png';
		$('#divisaoatual').show();
	}
	
	$('#current-image').attr('src', base_img + currentImage);
	
	$.ajax({
		url: 'https://elojobhigh.com.br/app/servico_preco.json',
		type: 'POST',
		dataType: 'json',
		data: 'servidor=elojoblol&servico=vitorias&' + data + '&fila=' + fila,
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
	$('.fila').click(function() {
		var fila_tmp = $(this).data('value').toLowerCase();
		
		fila = fila_tmp;
		
		if(fila_tmp == "solo/duo") {
			$('#fila-flex').removeClass('active');
			$('#fila-soloduo').addClass('active');
		} else {
			$('#fila-soloduo').removeClass('active');
			$('#fila-flex').addClass('active');
		}
		
		$('#form-service').submit();
	});
	$('#ligaatual, #divisaoatual, #quantidade').change(function() {
		$('#form-service').submit();
	});
	$('#form-service').submit(function() {
		getPrecoServico($(this).serialize());
		return false;
	}).submit();
});