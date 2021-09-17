$(document).ready(function(){
    /* Atribui o select 2 aos inputs com a classe select2 */
    $(".select2").select2({
        width: '100%',
    });

    /** Adiciona a classe loaded para remover o loading */
    setTimeout(() => {
        loadingScreen(false)
    }, 500);
});

/** **************** DELETE BUTTONS *******************
 * Atribuímos diretamente na tag html o onclick chamando a função
 * apenas os botões da grid gerados com DataTable.
 *
 * Para os demais botoões de deletar, pegamos todos da página pela classe
 * e criamos o eventListener click para chamar a função e deletar o registro
 */
const deleteButtons = document.querySelectorAll('.delete-button')
for(const [key, button] of Object.entries(deleteButtons)) {
    button.addEventListener('click', function() {
        deleteRegister(this)
    });
}

function deleteRegister(button) {
    const codigo = button.getAttribute('data-id');
    const url = button.getAttribute('data-href');
    const _method = button.getAttribute('data-method');
    const item = button.getAttribute('data-item');
    const name = button.getAttribute('data-name');

    /**
     * No caso dos modelos de grid que excluímos pelo botão no modal,
     * ao clicar no botão de delete, retiramos o modal
    */
    if(item === 'Modelo da grid') $('#modeloGridExcel').modal('hide');

    bootbox.confirm({
        title: `Excluir ${item} ${name}`,
        message: "Deseja realmente excluir este item ?",
        className: 'fadeIn',
        buttons: {
            confirm: {
                label: '<i class="fa fa-check"></i> Sim',
            },
            cancel: {
                label: '<i class="fa fa-times"></i> Não',
                className: 'btn-default'
            }
        },
        callback: function (result) {
            if(result)
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { data: codigo, _method: _method},
                    success: function(data){
                        bootbox.alert({
                            message: data.message,
                            className: 'fadeIn',
                            callback: function(){
                                if(data.urlRedirect) window.location.href = data.urlRedirect;
                                else location.reload();
                            }
                        });
                    },
                    error:function(error){
                        console.log(error);
                    },
                });
            }
        }
    });

    return false;
}

/** Função para exibir ou remover o loading da tela */
const loadingScreen = isLoading => isLoading ? document.body.classList.remove('loaded') : document.body.classList.add('loaded');
