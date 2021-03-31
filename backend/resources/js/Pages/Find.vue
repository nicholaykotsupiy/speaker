<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white py-6 overflow-hidden  shadow-xl sm:rounded-lg">
                    <div class="flex justify-center">
                        <input
                            type="search"
                            name="search"
                            placeholder="Search..."
                            class="p-1 px-2 text-base rounded-md"
                        >
                        <button class="px-4 py-2 mx-2 bg-blue-500 rounded-md">Search</button>
                    </div>
                    <div class="">
                        <div v-if="true">
                            <ul>
                                <li class="py-4 px-2 border-b-2 cursor-pointer hover:bg-gray-100">
                                    Jon Smit
                                </li>
                                <li class="py-4 px-2 border-b-2 cursor-pointer hover:bg-gray-100">
                                    Rin Haru
                                </li>
                                <li class="py-4 px-2 border-b-2 cursor-pointer hover:bg-gray-100">
                                    Den Kuzo
                                </li>
                            </ul>
                        </div>
                        <div v-else class="text-center">
                            Nothing find
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'

export default {
    components: {
        AppLayout,
    },
}
</script>
