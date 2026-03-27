<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { index, list } from '@/routes/files';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Badge from 'primevue/badge';
import { FilterMatchMode } from '@primevue/core/api';
import { onMounted, ref } from 'vue';
import InputText from 'primevue/inputtext';
import type { CachedFile } from '@/types';
import DeleteCache from '@/pages/files/DeleteCache.vue';

const loading = ref(false);
const files = ref<CachedFile[]>([]);

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

onMounted(async () => {
    try {
        loading.value = true;
        const response = await fetch(list().url, {
            method: list().method,
            headers: {
                Accept: 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error(`Errore HTTP: ${response.status}`);
        }

        files.value = await response.json();
    } catch (e) {
        console.error(e);
    } finally {
        loading.value = false;
    }
});
</script>

<template>
    <Head title="Pagine" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-4 py-6">
            <DataTable
                :value="files"
                :loading
                :rows="100"
                paginator
                size="small"
                v-model:filters="filters"
                :globalFilterFields="['uri', 'index', 'amp']"
            >
                <template #header>
                    <div>
                        <InputText v-model="filters['global'].value" placeholder="Cerca..." size="small" fluid />
                    </div>
                </template>
                <Column field="uri" header="URI" />
                <Column header="Cache">
                    <template #body="{ data }: { data: CachedFile }">
                        <div class="flex items-center gap-1">
                            <Badge :severity="data.index ? 'success' : 'danger'" value="DEFAULT" />
                            <Badge :severity="data.amp ? 'success' : 'danger'" value="AMP" />
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
