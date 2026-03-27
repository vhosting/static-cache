<script setup lang="ts">
import type { InertiaForm } from '@inertiajs/vue3';
import Button from 'primevue/button';

defineProps<{
    form: InertiaForm<any>;
    size?: 'small' | 'large';
}>();
</script>

<template>
    <div>
        <Button type="submit" :size :disabled="!form.isDirty || form.processing" label="Salva" />

        <div v-show="form.isDirty" class="mt-2 text-sm text-yellow-600 dark:text-yellow-500">
            Ci sono modifiche non salvate. Salva il form prima di continuare.
        </div>
    </div>
</template>

<style scoped></style>
