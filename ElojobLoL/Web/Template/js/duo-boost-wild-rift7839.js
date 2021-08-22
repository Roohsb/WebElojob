var modo = "divisao";
var plano = "basico";

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
	var quantidade = $('#quantidade').val();
	
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
		data: 'servidor=elojoblol&servico=wildriftduoboost&' + data + '&modo=' + modo + '&plano=' + plano,
		beforeSend: function() {
			$('#resultado').html('<div class="col-sm text-center text-white"><img src="assets/imagens/preload.png" alt="carregando..." width="55" style="margin: 0 auto;" /></div>');
		},
		success: function(data) {
			if(data.status == '1') {				
				if(cupom_ativo) {
					var valor_desconto = formatMoneyUS(data.total) - (formatMoneyUS(data.total) / 100 * cupom_desconto);
					var html = '<div class="col"><p class="price-old">DE: R$ ' + data.total + '</p>';
					html += '<p class="price">R$ ' + formatMoneyBR(valor_desconto) + '</p>';
					html += '<p class="cupom">' + cupom_desconto + '% de desconto com o cupom <strong>' + cupom_nome + '</strong></p></div>';
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
	$('.modo').click(function() {
		var modo_tmp = $(this).data('value').toLowerCase();
		
		modo = modo_tmp;
		
		if(modo_tmp == "divisao") {
			$('#modo-vitoria').removeClass('active');
			$('#modo-divisao').addClass('active');
			
			$('#box-quantidade').addClass("d-none");
			$('#box-elodesejado').removeClass("d-none");
			$("#ligaatual option[value='mestre'], #ligadesejada option[value='mestre']").show();
		} else {
			$('#modo-divisao').removeClass('active');
			$('#modo-vitoria').addClass('active');
			
			$('#box-elodesejado').addClass("d-none");
			$('#box-quantidade').removeClass("d-none");
			$("#ligaatual option[value='mestre'], #ligadesejada option[value='mestre']").hide();
			
			if($("#ligaatual").val() == 'mestre') {
				$('#ligaatual option[value="diamante"]').prop('selected', 'selected').change();
			}
		}
		
		$('#form-service').submit();
	});
	$('.plano').click(function() {
		var plano_tmp = $(this).data('value').toLowerCase();
		
		plano = plano_tmp;
		
		if(plano_tmp == 'basico') {
			$('#plano-premium').removeClass('active');
			$('#plano-basico').addClass('active');
			
			$('#msg-plano-premium').addClass("d-none");
			$('#msg-plano-basico').removeClass("d-none");
		} else {
			$('#plano-basico').removeClass('active');
			$('#plano-premium').addClass('active');
			
			$('#msg-plano-basico').addClass("d-none");
			$('#msg-plano-premium').removeClass("d-none");
		}
		
		$('#form-service').submit();
	});
	$('#ligaatual, #ligadesejada, #divisaoatual, #divisaodesejada, #quantidade').change(function() {
		$('#form-service').submit();
	});
	$('#form-service').submit(function() {
		getPrecoServico($(this).serialize());
		return false;
	}).submit();
});