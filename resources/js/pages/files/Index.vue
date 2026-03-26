<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { index } from '@/routes/files';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Badge from 'primevue/badge';
import { FilterMatchMode } from '@primevue/core/api';
import { ref } from 'vue';
import InputText from 'primevue/inputtext';
import type { CachedFile } from '@/types';
import DeleteCache from '@/pages/files/DeleteCache.vue';

defineProps<{
    files: CachedFile[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pagine',
        href: index(),
    },
];

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    uri: { value: null, matchMode: FilterMatchMode.CONTAINS },
    index: { value: null, matchMode: FilterMatchMode.EQUALS },
    amp: { value: null, matchMode: FilterMatchMode.EQUALS },
});

</script>

<template>
    <Head title="Pagine" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-2">
            <DataTable
                :value="files"
                :rows="100"
                paginator
                size="small"
                v-model:filters="filters"
                :globalFilterFields="['uri', 'index', 'amp']"
            >
                <template #header>
                    <div>
                        <InputText
                            v-model="filters['global'].value"
                            placeholder="Cerca..."
                            size="small"
                            fluid
                        />
                    </div>
                </template>
                <Column field="uri" header="URI" />
                <Column header="Cache">
                    <template #body="{ data }: { data: CachedFile }">
                        <div class="flex items-center gap-1">
                            <Badge
                                :severity="data.index ? 'success' : 'danger'"
                                value="DEFAULT"
                            />
                            <Badge
                                :severity="data.amp ? 'success' : 'danger'"
                                value="AMP"
                            />
                        </div>
                    </template>
                </Column>
                <Column header="Azioni">
                    <template #body="{ data }: { data: CachedFile }">
                        <DeleteCache :file="data" />
                    </template>
                </Column>
                <template #empty>Nessun URI trovato.</template>
            </DataTable>
        </div>
    </AppLayout>
</template>

<style scoped></style>
