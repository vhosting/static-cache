<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, ResourcePaginator, User } from '@/types';
import * as users from '@/routes/users';
import { useDialogs } from '@/composables/useDialogs';
import ButtonLink from '@/components/ButtonLink.vue';
import Pagination from '@/components/Pagination.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';

defineProps<{
    items: ResourcePaginator<User>;
}>();

const { confirmDelete } = useDialogs();

const title = 'Utenti';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: title,
        href: users.index(),
    },
];

async function deleteItem(id: number) {
    if (await confirmDelete()) {
        router.delete(users.destroy(id));
    }
}
</script>

<template>
    <Head :title />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-4 py-6">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold">{{ title }} ({{ items.meta.total }})</h1>
                <ButtonLink size="small" :href="users.create()" label="Crea utente" />
            </div>

            <DataTable :value="items.data" lazy size="small">
                <Column field="name" header="Nome" />
                <Column field="email" header="Email" />
                <Column header="Azioni" :pt="{ columnHeaderContent: { class: 'justify-end' } }">
                    <template #body="{ data }: { data: User }">
                        <div class="flex justify-end gap-2">
                            <ButtonLink
                                severity="secondary"
                                size="small"
                                :href="users.edit(data.id)"
                                label="Modifica"
                            />
                            <Button severity="danger" size="small" @click="() => deleteItem(data.id)" label="Elimina" />
                        </div>
                    </template>
                </Column>
            </DataTable>

            <Pagination :paginator="items" />
        </div>
    </AppLayout>
</template>
