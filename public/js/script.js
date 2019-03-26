$.fn.select2.defaults.set("theme", "bootstrap");
$(document).ready(function() {
    $('.select2').select2();

    $('#mycp').colorpicker({
        format: "hexa"
    });

    //datatable
    $('.datatable').DataTable({
        order: [
            [0, 'desc']
        ],
        "paging": false,
        "searching": false,
    });
    $('.datatable-page').DataTable({order: [[0, 'desc']]});
});

$(document).on('click', '.senha-display', function(event) {
    event.preventDefault();    
    var tipo = $('input[name=senha]').attr('type');
    if(tipo === 'password'){
        $('#senha').attr('type', 'text');
        $(this).html('<i class="fa fa-eye fa-fw"></i>');
    } else {
        $('#senha').attr('type', 'password');
        $(this).html('<i class="fa fa-eye-slash fa-fw"></i>');
    }
});

$(document).on('click', '.tarefa-check-uncheck', function(event) {
    event.preventDefault();
    var el = $(this);
    var id = el.val();
    var status = el.data('status');
    if (id) {
        $.get('/pages/tarefas-action?acao=checked', {
            id: id,
            status: status
        }, function(data) {
            if (data) {
                el.parent().parent().parent().fadeOut(300, function() {
                    el.parent().parent().parent().remove();
                });
            }
        });
    }
});

//remover
$(document).on('click', '.tarefa-delete', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    if (id) {

        // confirm dialog
        alertify.confirm('Confirma a exclusão?', function() {

            $.get('/pages/tarefas-action?acao=excluir', {
                id: id
            }, function(data) {
                if (data) {
                    $('#RT' + id).fadeOut(300, function() {
                        $('#RT' + id).remove();
                    });
                }
            });

        }, function() {
            // user clicked "cancel"
        });
    }
});

//editar
$(document).on('click', '.btn-edit-tarefa', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $('#modal-tarefas .modal-body').html('');
    if (id) {
        $.get('/pages/tarefas-action?acao=editar', {
            id: id
        }, function(data) {
            if (data) {
                $('#modal-tarefas .modal-body').html(data);
            }
        });
    }
});

//funcao para exportar dados dos PDVS
$(document).on('submit', '#form-tarefas', function(event) {
    event.preventDefault();

    var data = $(this).serialize();
    var action = $(this).attr('action');

    if (data) {
        $.post(action, data, function(data, textStatus, xhr) {
            if (data) {
                $("#tb-tarefas tbody").html(data);
            }
        });
    }
    //$(this)[0].reset();
    //$("#id_projeto").trigger('change');
    $('#descricao').val('');
    $('#modal-tarefas').modal('hide');
});



