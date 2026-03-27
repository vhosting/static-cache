<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import * as users from '@/routes/users';
import Heading from '@/components/Heading.vue';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import FormSubmit from '@/components/FormSubmit.vue';
import InputError from '@/components/InputError.vue';

const title = 'Crea utente';
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

const form = useForm({
    name: '',
    email: '',
    password: '',
});

const submit = () => form.submit(users.store());
</script>

<template>
    <Head :title />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-4 py-6">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold">{{ title }}</h1>
            </div>

            <Heading variant="small" title="Informazioni base" class="mb-2" />

            <form @submit.prevent="submit" class="space-y-6">
                <div class="grid grid-cols-1 gap-x-2 gap-y-4 md:grid-cols-2 xl:grid-cols-4">
                    <!--NAME-->
                    <div class="flex flex-col gap-2">
                        <FloatLabel variant="on">
                            <InputText id="name" v-model="form.name" fluid />
                            <label for="name" class="required">Nome</label>
                        </FloatLabel>
                        <InputError :message="form.errors.name" />
                    </div>

                    <!--EMAIL-->
                    <div class="flex flex-col gap-2">
                        <FloatLabel variant="on">
                            <InputText id="email" v-model="form.email" fluid />
                            <label for="email" class="required">Email</label>
                        </FloatLabel>
                        <InputError :message="form.errors.email" />
                    </div>

                    <!--PASSWORD-->
                    <div class="flex flex-col gap-2">
                        <FloatLabel variant="on">
                            <InputText id="password" v-model="form.password" fluid />
                            <label for="password" class="required">Password</label>
                        </FloatLabel>
                        <InputError :message="form.errors.password" />
                    </div>
                </div>

                <FormSubmit :form />
            </form>
        </div>
    </AppLayout>
</template>
