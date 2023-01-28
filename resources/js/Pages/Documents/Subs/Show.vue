<script setup>
import AppLayout from "../../../Layouts/AppLayout.vue";
import Card from "../../../Components/Card.vue";
import { PaperClipIcon } from "@heroicons/vue/24/outline";
import TextLink from "../../../Components/TextLink.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

defineProps({
    standard: Object,
    sub: Object,
    documents: Array,
});

const permissions = computed(() => {
    return usePage().props.auth.permissions;
});

const user = computed(() => {
    return usePage().props.auth.user;
});
</script>

<template>
    <AppLayout :title="sub.name">
        <div class="grid grid-cols-6 gap-5">
            <Card header class="col-span-6 sm:col-span-4">
                <template #header> Detail Dokumen</template>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Nomor Butir
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ sub.number }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Nama Sub
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ sub.name }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Total Dokumen
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ documents.length }}
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">
                            Deskripsi Tentang Sub
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ sub.description }}
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">
                            List Dokumen
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul
                                v-if="documents.length > 0"
                                role="list"
                                class="divide-y divide-gray-200 rounded-md border border-gray-200"
                            >
                                <li
                                    v-for="document in documents"
                                    :key="document.id"
                                    class="flex items-center justify-between py-3 pl-3 pr-4 text-sm"
                                >
                                    <div class="flex w-0 flex-1 items-center">
                                        <PaperClipIcon
                                            class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            aria-hidden="true"
                                        />
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            {{ document.name }}
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0 space-x-3">
                                        <TextLink
                                            v-if="
                                                permissions.includes(
                                                    'delete document'
                                                ) ||
                                                document.user_id === user.id
                                            "
                                            as="button"
                                            method="DELETE"
                                            :href="
                                                route(
                                                    'documents.subs.destroy',
                                                    document.id
                                                )
                                            "
                                            class="text-red-600 hover:text-red-500"
                                        >
                                            Hapus
                                        </TextLink>
                                        <a
                                            :href="
                                                route('download', document.id)
                                            "
                                            class="font-medium text-blue-600 hover:text-blue-500"
                                        >
                                            Unduh
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </Card>
            <Card class="col-span-6 sm:col-span-2"> Timeline</Card>
            <Card class="col-span-6 sm:col-span-4"> Notes</Card>
        </div>
    </AppLayout>
</template>
