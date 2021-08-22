function getPrecoServico(data) {
	var cupom_ativo = 1;
	var cupom_nome = "BRASIL20";
	var cupom_desconto = 20;
	$.ajax({
		url: 'https://elojobx.com/api/calculate-coach',
		type: 'POST',
		dataType: 'json',
		data: 'servidor=elojoblol&servico=coach&' + data,
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
				html += '<form method="POST" action='+data.Url+' id="contratar" hidden>'
				html += '<input type="hidden" name="curso" value="'+data.curso+'">'
				html += '<input type="hidden" name="aulas" value="'+data.quantidade+'">'
				html += '</form>';
				html += '	 <a href="javascript:{}" onclick="document.getElementById(\'contratar\').submit();" id="comprar" class="button-3" href="' + data.Url + '">CONTRATAR</a>';
				html += '</div>';
			} else {
				var html = '<div class="alert alert-danger" role="alert">' + data.mensagem + '</div>';
			}
			$('#resultado').html(html);
		}
	});
}

$(function() {
	$('#curso').change(function() {
		var curso = $(this).val();
		if(curso == 'iniciante') {
			$('#curso-intermediario').addClass("d-none");
			$('#curso-experiente').addClass("d-none");
			$('#curso-iniciante').removeClass("d-none");
		} else if(curso == 'intermediario') {
			$('#curso-iniciante').addClass("d-none");
			$('#curso-experiente').addClass("d-none");
			$('#curso-intermediario').removeClass("d-none");
		} else {
			$('#curso-iniciante').addClass("d-none");
			$('#curso-intermediario').addClass("d-none");
			$('#curso-experiente').removeClass("d-none");
		}
	});
	$('#curso, #qtdaulas, #amigo').change(function() {
		$('#form-service').submit();
	});
	$('#form-service').submit(function() {
		getPrecoServico($(this).serialize());
		return false;
	}).submit();
});