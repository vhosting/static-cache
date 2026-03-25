<script setup lang="ts">
import type { CachedFile } from '@/types';
import SplitButton from 'primevue/splitbutton';
import { clear } from '@/routes/files';
import { router } from '@inertiajs/vue3';

const { file } = defineProps<{
    file: CachedFile;
}>();

const deleteMenu = [
    {
        label: 'DEFAULT',
        command: () => deleteAction(file.uri + '-index', 'starts_with'),
    },
    {
        label: 'AMP',
        command: () => deleteAction(file.uri + '-amp', 'starts_with'),
    },
];

function deleteAll() {
    deleteAction(file.uri, 'starts_with');
}

function deleteAction(pattern: string, method: string) {
    router.visit(clear(), {
        data: { pattern, method },
    });
}
</script>

<template>
    <SplitButton
        label="Cancella"
        size="small"
        severity="danger"
        :model="deleteMenu"
        @click="deleteAll"
    />
</template>

<style scoped></style>
