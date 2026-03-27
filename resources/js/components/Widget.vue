<script setup lang="ts">
import type { LucideIcon } from '@lucide/vue';

const {
    iconClass = 'bg-slate-500',
    value = 0,
} = defineProps<{
    label: string;
    value?: any;
    icon: LucideIcon;
    iconClass?: string;
}>();
</script>

<template>
    <div class="rounded-2xl bg-surface-0 p-5 shadow-sm dark:bg-surface-900">
        <div class="flex justify-between gap-4">
            <div class="flex flex-col gap-2">
                <span
                    class="leading-tight font-bold text-surface-700 dark:text-surface-300"
                >
                    {{ label }}
                </span>
                <div
                    class="text-2xl! leading-tight! font-semibold text-surface-900 dark:text-surface-0"
                >
                    <slot>{{ value }}</slot>
                </div>
            </div>
            <div
                class="flex h-10 w-10 items-center justify-center rounded-lg"
                :class="iconClass"
            >
                <component
                    :is="icon"
                    class="text-xl! leading-none! text-white"
                />
            </div>
        </div>
    </div>
</template>

<style scoped></style>
