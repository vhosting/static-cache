<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, User } from '@/types';
import * as users from '@/routes/users';
import Heading from '@/components/Heading.vue';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import FormSubmit from '@/components/FormSubmit.vue';
import InputError from '@/components/InputError.vue';

const { item } = defineProps<{
    item: User;
}>();

const title = 'Modifica utente';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Utenti',
        href: users.index(),
    },
    {
        title: title,
        href: '#',
    },
];

const formBase = useForm({
    name: item.name,
    email: item.email,
});
const submitBase = () => formBase.submit(users.update(item.id));

const formPassword = useForm({
    password: '',
});
const submitPassword = () => formPassword.submit(users.password(item.id));
</script>

<template>
    <Head :title />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-4 py-6">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold">{{ title }}</h1>
            </div>

            <!-- FORM INFO -->
            <Heading variant="small" title="Informazioni base" class="mb-2" />
            <form @submit.prevent="submitBase" class="space-y-6">
                <div class="grid grid-cols-1 gap-x-2 gap-y-4 md:grid-cols-2 xl:grid-cols-4">
                    <!--NAME-->
                    <div class="flex flex-col gap-2">
                        <FloatLabel variant="on">
                            <InputText id="name" v-model="formBase.name" fluid />
                            <label for="name" class="required">Nome</label>
                        </FloatLabel>
                        <InputError :message="formBase.errors.name" />
                    </div>

                    <!--EMAIL-->
                    <div class="flex flex-col gap-2">
                        <FloatLabel variant="on">
                            <InputText id="email" v-model="formBase.email" fluid />
                            <label for="email" class="required">Email</label>
                        </FloatLabel>
                        <InputError :message="formBase.errors.email" />
                    </div>
                </div>

                <FormSubmit :form="formBase" />
            </form>

            <!-- FORM PASSWORD -->
            <Heading variant="small" title="Aggiorna password" class="mt-8 mb-2" />
            <form @submit.prevent="submitPassword()" class="space-y-6">
                <div class="grid grid-cols-1 gap-x-2 gap-y-4 md:grid-cols-2 xl:grid-cols-4">
                    <!--PASSWORD-->
                    <div class="flex flex-col gap-2">
                        <FloatLabel variant="on">
                            <InputText id="password" v-model="formPassword.password" fluid />
                            <label for="password" class="required">Password</label>
                        </FloatLabel>
                        <InputError :message="formPassword.errors.password" />
                    </div>
                </div>

                <FormSubmit :form="formPassword" />
            </form>
        </div>
    </AppLayout>
</template>
