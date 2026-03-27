<script setup lang="ts">
import type { ResourcePaginator } from '@/types';
import { router } from '@inertiajs/vue3';
import PrimePaginator from 'primevue/paginator';
import type { PageState } from 'primevue/paginator';
import { computed } from 'vue';

const {
    paginator,
    remote = false,
    small = false,
} = defineProps<{
    paginator?: ResourcePaginator<any> | undefined;
    remote?: boolean;
    small?: boolean;
}>();

const emit = defineEmits(['change']);

const totalRecords = computed(() => {
    if (paginator === undefined) {
        return 0;
    }

    return Math.ceil(paginator.meta.total / paginator.meta.per_page);
});

const currentPage = computed(() => {
    if (paginator === undefined) {
        return 1;
    }

    return paginator.meta.current_page;
});

const paginatorTemplate = {
    '640px': 'FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink',
    '960px': 'FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink',
    '1300px': 'FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink',
    default: 'FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink',
};

function getPageLink(page: number): string {
    if (paginator === undefined) {
        return '#';
    }

    const firstPageUrl = paginator.links.first;
    const url = new URL(firstPageUrl);
    url.searchParams.set('page', page.toString());

    return url.toString();
}

function onPageChange(event: PageState) {
    if (remote) {
        emit('change', getPageLink(event.page + 1));

        return;
    }

    router.visit(getPageLink(event.page + 1), {
        preserveScroll: true,
    });
}
</script>

<template>
    <PrimePaginator
        :first="currentPage - 1"
        :rows="1"
        :totalRecords="totalRecords"
        :pageLinkSize="10"
        :alwaysShow="false"
        v-on:page="onPageChange"
        pt:root:class="bg-transparent!"
        :pt:content:class="{ 'p-0': small, 'p-1': !small }"
        :pt="
            small
                ? {
                      page: { class: 'min-w-8 h-8' },
                      prev: { class: 'min-w-8 h-8' },
                      first: { class: 'min-w-8 h-8' },
                      last: { class: 'min-w-8 h-8' },
                      next: { class: 'min-w-8 h-8' },
                  }
                : {}
        "
        currentPageReportTemplate="{first} di {totalRecords}"
        :template="paginatorTemplate"
    >
    </PrimePaginator>
</template>

<style scoped></style>
