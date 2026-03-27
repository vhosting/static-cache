<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Toast, ToastContainer } from 'vue-toastflow';
import { CircleCheck, CircleX, TriangleAlert } from '@lucide/vue';
import { useToast } from '@/composables/useToast';
import { onMounted, onUnmounted } from 'vue';
import { router } from '@inertiajs/vue3';
import ConfirmDialog from 'primevue/confirmdialog';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const { success, warning, error } = useToast();
let flashListener: null | (() => void) = null;

onMounted(() => {
    flashListener = router.on('flash', (event) => {
        if (event.detail.flash['toast.success']) {
            success(event.detail.flash['toast.success'] as string);
        }

        if (event.detail.flash['toast.error']) {
            error(event.detail.flash['toast.error'] as string);
        }

        if (event.detail.flash['toast.warning']) {
            warning(event.detail.flash['toast.warning'] as string);
        }
    });
});

onUnmounted(() => {
    if (flashListener !== null) {
        flashListener();
    }
});
</script>

<template>
    <ToastContainer v-slot="{ toast, dismiss }">
        <Toast :toast="toast" @dismiss="dismiss">
            <template
                #icon="{ toast }"
                v-if="['success', 'warning', 'error'].includes(toast.type)"
            >
                <CircleCheck v-if="toast.type === 'success'" />
                <TriangleAlert v-if="toast.type === 'warning'" />
                <CircleX v-if="toast.type === 'error'" />
            </template>
        </Toast>
    </ToastContainer>

    <ConfirmDialog />

    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
</template>
