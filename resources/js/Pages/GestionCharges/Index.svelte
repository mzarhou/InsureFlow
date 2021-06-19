<script>
import Layout from "@/Pages/Layouts/AdminLayout.svelte";
import { Inertia } from "@inertiajs/inertia"
import EditForm from "@/Components/sections/GestionCharges/Index/EditForm.svelte"
import AddForm from "@/Components/sections/GestionCharges/Index/AddForm.svelte"
import DeleteForm from "@/Components/sections/GestionCharges/Index/DeleteForm.svelte"
import dayjs from "dayjs";
import { fade } from "svelte/transition";

export let charges = [];
</script>

<Layout>
    <main class="p-4">
        <div class="flex flex-wrap-reverse justify-between -mt-4">
            <!-- ajouter -->
            <AddForm />
        </div>
        <table class="table w-full p-4 mt-4 bg-white rounded-lg shadow">
            <thead>
                <tr>
                    <th class="p-4 font-normal text-gray-900 border dark:border-dark-5 whitespace-nowrap">
                        Date
                    </th>
                    <th class="p-4 font-normal text-gray-900 border dark:border-dark-5 whitespace-nowrap">
                        Montant (DH)
                    </th>
                    <th class="p-4 font-normal text-gray-900 border dark:border-dark-5 whitespace-nowrap">
                        Description
                    </th>
                    <th class="p-4 font-normal text-gray-900 border dark:border-dark-5 whitespace-nowrap">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                {#each charges as charge, key}
                <tr key={key} class="text-gray-700" transition:fade={{ delay: 20 * key, duration: 300 }}>
                    <td class="p-4 border dark:border-dark-5">{dayjs(charge.created_at).format("DD-MM-YYYY HH:mm")}</td>
                    <td class="p-4 border dark:border-dark-5">{charge.montant}</td>
                    <td class="p-4 border dark:border-dark-5">{charge.description}</td>
                    <td class="p-4 text-center border dark:border-dark-5">
                        <!-- Modifier -->
                        <EditForm charge={charge} />
                        <DeleteForm charge={charge} />
                    </td>
                </tr>
                {/each}
            </tbody>
        </table>
    </main>
</Layout>
