/* Lista de Contatos Internos
    * Função que faz a busca dos filtros da tabela
*/
$(function(){
    $("#ramalList input").keyup(function(){       
        var index = $(this).parent().index();
        var nth = "#ramalList td:nth-child("+(index+1).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#ramalList tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });

    $("#ramalList input").blur(function(){
        $(this).val("");
    });
});