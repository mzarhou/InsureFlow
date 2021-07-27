<script context="module">
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    export const layout = Layout
</script>

<script>
    import EditForm from "@/Components/sections/GestionCharges/Index/EditForm.svelte"
    import AddForm from "@/Components/sections/GestionCharges/Index/AddForm.svelte"
    import DeleteForm from "@/Components/sections/GestionCharges/Index/DeleteForm.svelte"
    import dayjs from "dayjs";
    import { fade } from "svelte/transition";

    export let charges = [];
</script>

<main class="mrg-left p-4">
    <div class="flex flex-wrap-reverse justify-between -mt-4">
        <!-- ajouter -->
        <AddForm />
    </div>
    {#if charges.length > 0}
    <table class="table w-full p-4 mt-4 bg-white rounded-lg shadow">
        <thead>
            <tr>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    Date
                </th>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    Montant (DH)
                </th>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    Description
                </th>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            {#each charges as charge, key}
            <tr key={key} class="text-gray-700" transition:fade={{ delay: 20 * key, duration: 300 }}>
                <td class="dark:border-dark-5 p-4 border">{dayjs(charge.created_at).format("DD-MM-YYYY HH:mm")}</td>
                <td class="dark:border-dark-5 p-4 border">{charge.montant}</td>
                <td class="dark:border-dark-5 p-4 border">{charge.description}</td>
                <td class="dark:border-dark-5 p-4 text-center border">
                    <!-- Modifier -->
                    <EditForm charge={charge} />
                    <DeleteForm charge={charge} />
                </td>
            </tr>
            {/each}
        </tbody>
    </table>
    {:else}
        <h3 class="md:text-4xl mt-6 text-xl text-center text-gray-400">Il n'y a pas de charges</h3>
    {/if}
</main>
