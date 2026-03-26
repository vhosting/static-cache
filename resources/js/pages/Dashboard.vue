<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { home } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import { Deferred } from '@inertiajs/vue3';
import Skeleton from 'primevue/skeleton';
import Widget from '@/components/Widget.vue';
import { SquareLibrary, Globe, Zap } from 'lucide-vue-next';

defineProps<{
    stats?: {
        total_pages: number;
        index_pages: number;
        amp_pages: number;
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: home(),
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="grid auto-rows-min gap-4 lg:grid-cols-3">
                <Widget
                    label="Pagine Totali"
                    :icon="SquareLibrary"
                    iconClass="bg-green-700"
                >
                    <Deferred data="stats">
                        <template #fallback>
                            <Skeleton height="2rem"></Skeleton>
                        </template>

                        {{ stats?.total_pages ?? 0 }}
                    </Deferred>
                </Widget>

                <Widget
                    label="Pagine Default"
                    :icon="Globe"
                    iconClass="bg-orange-600"
                >
                    <Deferred data="stats">
                        <template #fallback>
                            <Skeleton height="2rem"></Skeleton>
                        </template>

                        {{ stats?.index_pages ?? 0 }}
                    </Deferred>
                </Widget>

                <Widget
                    label="Pagine AMP"
                    :icon="Zap"
                    iconClass="bg-blue-600"
                >
                    <Deferred data="stats">
                        <template #fallback>
                            <Skeleton height="2rem"></Skeleton>
                        </template>

                        {{ stats?.amp_pages ?? 0 }}
                    </Deferred>
                </Widget>
            </div>
        </div>
    </AppLayout>
</template>
