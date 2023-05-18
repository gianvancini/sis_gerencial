@extends('adminlte::page')

@section('plugins.Sweetalert2', true)

@section('js')
    <script>
        function ConfirmaExclusao(id) {
            swal.fire({
                title: "Confirma a exclusão?",
                text: "Esta ação não poderá ser revertida!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085D6",
                cancelButtonColor: "#D33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar!",
                closeOnConfirm: false,
                focusCancel: true,
            }).then(function(isConfirm) {
                if(isConfirm.value) {
                    $.get('/' + @yield('table-delete') + '/destroy?id=' + id, function(data) {
                        swal.fire(
                            "Deletado!",
                            "Exclusão confirmada.",
                            "success"
                        ).then(function() {
                            window.location.reload();
                        });
                    });
                }
            });
        }
    </script>
