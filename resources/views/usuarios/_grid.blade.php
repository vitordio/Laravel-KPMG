<div class="m-t-25">
    <table id="ajax-data-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>@lang('labels.id')</th>
                <th>@lang('labels.des_nome')</th>
                <th>@lang('labels.des_email')</th>
                <th>@lang('labels.des_cpf')</th>
                <th>@lang('labels.updated_at')</th>
                <th>@lang('labels.flg_ativo')</th>
                <th span="3">@lang('labels.acoes')</th>
            </tr>
        </thead>
        {{-- Populamos a tabela com o yajra/DataTable ajax --}}
        <tbody>
        </tbody>
    </table>
</div>

@section('scripts')

    <script>
        $(document).ready(function() {
            const arrColunas = [
                { data: 'id', name: 'id' },
                { data: 'des_nome', name: 'des_nome' },
                { data: 'des_email', name: 'des_email' },
                { data: 'des_cpf', name: 'des_cpf' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'flg_ativo', name: 'flg_ativo' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ];

            $('#ajax-data-table').DataTable(
            {
                serverSide: true,
                ajax: "{{ route('usuario.ajaxDataTable') }}",
                columns: arrColunas,
                searching: true,
                paging: true,
                sort: true,
                info: false,
                scrollX: true,
                autoWidth: false,
                pageLength: 30,
                lengthMenu: [[10, 30, 50, -1], [10, 30, 50, "Todos"]],
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                },
            });
        } );
    </script>

@endsection
