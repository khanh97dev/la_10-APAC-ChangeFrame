@extends('layouts.main')
@section('title', 'Example page')

@section('content')
<div class="q-pa-md">
    <q-table
        :rows="{{ $data }}"
        :columns="{{ $header }}"
        row-key="name"
        @request="props => $cProperty.passWindow('updatePagination', props)"
        :pagination="{
            rowsNumber: {{ $totalNumber }},
            rowsPerPage: {{ request(K_PER_PAGE, V_PER_PAGE) }},
            page: {{ request(K_PAGE, V_PAGE) }},
            sortBy: '{{ request(K_SORT_BY, K_SORT_BY) }}'
        }"
    >
        <template v-slot:body-cell-actions="props">
            <q-tr :props="props">
                <q-td
                    key="actions"
                    :props="props"
                >
                    <q-btn
                        icon="mode_edit"
                        @click="() => $cProperty.passWindow('example_updateRow', props.row)"
                    ></q-btn>
                    <q-btn
                        icon="delete"
                        @click="() => $cProperty.passWindow('example_deleteRow', props.row)"
                    ></q-btn>
                </q-td>
            </q-tr>
        </template>
    </q-table>
</div>
@endsection

@include('helper-js')
<script>
    function example_updateRow(row) {
        return location.href = location.pathname + '/edit/' + row.id
    }

    function example_deleteRow(row) {
        // location
    }

    function example_updatePagination(props) {
        const pagination = props.pagination
        updatePagination(pagination);
        window.location.reload();
    }
</script>
