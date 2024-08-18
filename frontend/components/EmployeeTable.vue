<script setup lang="js">
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import { FilterMatchMode } from '@primevue/core/api';
import { useToast } from 'primevue/usetoast';


const props = defineProps({
  tableData: {
    type: Array,
    required: true,
  },
});

const toast = useToast();

const columns = ref([
  { field: 'nip', header: 'Nip' },
  { field: 'name', header: 'Name' },
  { field: 'group', header: 'Group' },
  { field: 'eselon', header: 'Eselon' },
  { field: 'position', header: 'Position' },
  { field: 'workplace', header: 'Workplace' },
  { field: 'unit', header: 'Unit' },
]);

const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const onRefresh = () => {
  window.location.reload();
};

const onDownload = () => handleDownload(toast);
</script>

<template>
  <Toast />
  <DataTable
    v-model:filters="filters"
    dataKey="id"
    filterDisplay="row"
    :loading="loading"
    :value="tableData"
    removableSort
    paginator
    :rows="5"
    :rowsPerPageOptions="[5, 10, 20, 50]"
    :globalFilterFields="[
      'nip',
      'name',
      'group',
      'eselon',
      'position',
      'workplace',
      'unit',
    ]"
    tableStyle="min-width: 50rem"
  >
    <template #header>
      <div>
        <IconField>
          <InputIcon class="pi pi-search" />
          <InputText id="search" v-model="filters['global'].value" />
        </IconField>
      </div>
    </template>

    <template #empty> No customers found. </template>
    <template #loading> Loading customers data. Please wait. </template>
    <template #paginatorstart>
        <Button type="button" @click="onRefresh" icon="pi pi-refresh" text />
    </template>
    <template #paginatorend>
        <Button type="button" @click="onDownload" icon="pi pi-download" text />
    </template>
    <Column
      v-for="col in columns"
      :key="col.field"
      :field="col.field"
      :header="col.header"
      sortable
    ></Column>

    <Column header="Action">
      <template #body="slotProps">
        <NuxtLink :to="`/Update/${slotProps.data.nip}`">
          <Button icon="pi pi-eye" />
        </NuxtLink>
      </template>
    </Column>
  </DataTable>
</template>
