<script setup lang="ts">
import { cn } from '@/lib/utils';
import type { Method } from '@inertiajs/core';
import Button from 'primevue/button';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

defineOptions({ inheritAttrs: false });

defineProps<{
    href: string | { url: string; method: Method };
    label?: string;
    size?: 'small' | 'large';
    severity?: 'secondary' | 'success' | 'info' | 'warn' | 'help' | 'danger' | 'contrast';
    variant?: 'link' | 'text' | 'outlined';
    disabled?: boolean;
    buttonClass?: string;
    method?: 'get' | 'post' | 'put' | 'patch' | 'delete';
    showLoading?: boolean;
}>();

const loading = ref(false);

const onStart = function () {
    loading.value = true;
};

const onFinish = function () {
    loading.value = false;
};
</script>

<template>
    <Button asChild v-slot="slotProps" :size :severity :variant :disabled v-if="!showLoading || !loading">
        <Link
            :onStart="onStart"
            :onFinish="onFinish"
            :href
            :method="method ?? 'get'"
            :class="cn(slotProps.class, 'font-medium', $attrs.class)"
        >
            <slot>
                {{ label }}
            </slot>
        </Link>
    </Button>

    <Button
        v-if="showLoading && loading"
        :loading
        label="Caricamento..."
        :size
        :severity
        :variant
        :disabled
        :class="cn('font-medium', $attrs.class)"
    />
</template>

<style scoped></style>
