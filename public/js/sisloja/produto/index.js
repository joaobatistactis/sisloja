$(document).ready(function(){
    $('#btnPesquisa').click(function(){
        $('#tabela-pesquisa-produto').removeClass('hide');
    });
    grid.carrega($('#tabela-pesquisa-produto'), $('#form-produto'));
});