var modo = "divisao";
var fila = "solo/duo";
var plano = "basico";

function getPrecoServico(data) {
    var cupom_ativo = 1;
    var cupom_nome = "LORENJOB";
    var cupom_desconto = 20;
    var base_img = '/Template/imagens/badges/';
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
    if (elosSemDivisao.includes(ligaatual)) {
        var nomeEloAtual = ligaatual_;
        var currentImage = ligaatual + '.png';
        $('#divisaoatual').hide();
    } else {
        var nomeEloAtual = ligaatual_ + ' ' + divisaoatual_;
        var currentImage = ligaatual + '_' + divisaoatual + '.png';
        $('#divisaoatual').show();
    }
    if (elosSemDivisao.includes(ligadesejada)) {
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
        url: 'http://localhost:81/api/calculate-booster',
        type: 'POST',
        dataType: 'json',
        data: {atualelo: ligaatual, atualdivisao: divisaoatual, deseelo: ligadesejada, desedivisao: divisaodesejada, Fila: fila, servico: 'duoboost'},
        beforeSend: function() {
            $('#resultado').html('<div class="col-sm text-center text-white"><img src="assets/imagens/preload.png" alt="carregando..." width="55" style="margin: 0 auto;" /></div>');
        },
        success: function(data) {
            if (data.status == '1') {
                if (cupom_ativo) {
                    var valor_desconto = formatMoneyUS(data.Value) - (formatMoneyUS(data.Value) / 100 * cupom_desconto);
                    var html = '<div class="col"><p class="price-old">DE: R$ ' + data.Value + '</p>';
                    html += '<p class="price">R$ ' + formatMoneyBR(valor_desconto) + '</p>';
                    html += '<p class="cupom">' + cupom_desconto + '% de desconto com o cupom <strong>' + cupom_nome + '</strong></p></div>';
                } else {
                    var html = '<div class="col price">R$ ' + data.Value + '</div>';
                }
                html += '<div class="col d-flex text-right">';
                html += '<form method="POST" action='+data.Url+' id="contratar" hidden>'
                for(var prop in data) {
                    if (data.hasOwnProperty(prop)) {
                      html += `<input type="hidden" name="${prop}" value="${data[prop]}">`;
                    }
                  }
                html += '<input type="hidden" name="fila" value="'+fila+'">'
                html += '</form>'
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
    $('.modo').click(function() {
        var modo_tmp = $(this).data('value').toLowerCase();
        modo = modo_tmp;
        if (modo_tmp == "divisao") {
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
            if ($("#ligaatual").val() == 'mestre') {
                $('#ligaatual option[value="diamante"]').prop('selected', 'selected').change();
            }
        }
        $('#form-service').submit();
    });
    $('.fila').click(function() {
        var fila_tmp = $(this).data('value').toLowerCase();
        fila = fila_tmp;
        if (fila_tmp == "solo/duo") {
            $('#fila-flex').removeClass('active');
            $('#fila-soloduo').addClass('active');
        } else {
            $('#fila-soloduo').removeClass('active');
            $('#fila-flex').addClass('active');
        }
        $('#form-service').submit();
    });
    $('.plano').click(function() {
        var plano_tmp = $(this).data('value').toLowerCase();
        plano = plano_tmp;
        if (plano_tmp == 'basico') {
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