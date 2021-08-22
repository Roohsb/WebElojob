var urlCompra = "";
var maestrias_ = {};

function btnComprar() {
	var cupom_ativo = 1;
	var cupom_nome = "BRASIL20";
	var cupom_desconto = 20;
	
	var campeao = $("#campeao option:selected").val();
	var maestriainicial = $("#maestriainicial option:selected").val();
	var maestriafinal = $("#maestriafinal option:selected").val();
	
	if(campeao == '') {
		var html = "<div class=\"alert alert-danger\" role=\"alert\">O campo \"selecione o campeão\" é obrigatório.</div>";
	} else if(maestriainicial == '') {
		var html = "<div class=\"alert alert-danger\" role=\"alert\">O campo \"selecione a maestria inicial\" é obrigatório.</div>";
	} else if(maestriafinal == '') {
		var html = "<div class=\"alert alert-danger\" role=\"alert\">O campo \"selecione a maestria final\" é obrigatório.</div>";
	} else if(maestrias_[maestriainicial][0] >= maestrias_[maestriafinal][0]) {
		var html = "<div class=\"alert alert-danger\" role=\"alert\">O campo \"maestria inicial\" não pode ser maior ou igual a \"maestria final\".</div>";
	} else {
		var total = 0;
		var somar = 0;
		var getUrl = "&maestrias=";

		$.each(maestrias_, function(key, row) {
			if(somar) {
				total += parseFloat(row[1]);
				getUrl += campeao + "-" + key + ",";
			}
			if(maestriainicial == key) {
				somar = 1;
			} else if(maestriafinal == key) {
				somar = 0;
			}
		});
		
		getUrl = getUrl.replace(/,(\s+)?$/, '');
		
		total = formatMoneyBR(total);
		
		if(cupom_ativo) {
			var valor_desconto = formatMoneyUS(total) - (formatMoneyUS(total) / 100 * cupom_desconto);
			var html = '<div class="col"><p class="price-old">DE: R$ ' + total + '</p>';
			html += '<p class="price">R$ ' + formatMoneyBR(valor_desconto) + '</p>';
			html += '<p class="cupom">' + cupom_desconto + '% de desconto com o cupom <strong>' + cupom_nome + '</strong> + início imediato</p></div>';
		} else {
			var html = '<div class="col price">R$ ' + total + '</div>';
		}
		html += '<div class="col d-flex text-right">';
		html += '	<a id="comprar" class="button-3" href="' + urlCompra + getUrl + '">CONTRATAR</a>';
		html += '</div>';
	}
	
	$('#resultado').html(html);
}

$(function() {
	$('#resultado').html('<div class="col-sm text-center text-white"><img src="assets/imagens/preload.png" alt="carregando..." width="55" style="margin: 0 auto;" /></div>');
	
	$.ajax({
		url: 'https://elojobhigh.com.br/app/api/maestria',
		type: 'GET',
		dataType: 'json',
		success: function(data) {
			urlCompra = data.compra;
			
			var campeoes_option = "<option value=''>Selecione</option>";
			$(data.campeoes).each(function(index, row) {
				campeoes_option += "<option value='" + row.id + "' data-nome='" + row.campeao + "' data-avatar='" + row.imagem + "'>" + row.campeao + "</option>";
			});
			
			var maestrias_inicial = "<option value=''>Selecione</option>";
			maestrias_inicial += "<option value='m0' data-nome='m0' data-preco='0'>M0</option>";
			var maestrias_final = "<option value=''>Selecione</option>";
			var maestrias_option = "";
			
			maestrias_['m0'] = [0, 0];
			$(data.maestrias).each(function(index, row) {
				maestrias_[row.id] = [index + 1, row.preco];
				maestrias_option += "<option value='" + row.id + "' data-nome='" + row.nome + "' data-preco='" + row.preco + "'>" + row.id.toUpperCase() + "</option>";
			});
			
			$('#campeao').html(campeoes_option);
			$('#maestriainicial').html(maestrias_inicial + maestrias_option);
			$('#maestriafinal').html(maestrias_final + maestrias_option);
			
			$('#campeao option[value="1"]').attr('selected', true);
			$('#maestriainicial option[value="m0"]').attr('selected', true);
			$('#maestriafinal option[value="m1"]').attr('selected', true);
			$('#campeao').change();
			
			btnComprar();
		}
	});

	$('#campeao').change(function() {
		var campeao_avatar = $("#campeao option:selected").data('avatar');
		if(campeao_avatar === undefined) {
			campeao_avatar = "assets/imagens/campeao.png";
		}
		$('#img-campeao').attr('src', campeao_avatar);
	});
	
	$('#campeao, #maestriainicial, #maestriafinal').change(function() {
		btnComprar();
	});
});