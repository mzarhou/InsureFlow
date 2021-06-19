<script>
    import Modal from "@/Components/app/Modal.svelte";
    import AddPaiementForm from "@/Components/sections/Credit/Show/AddPaiementForm.svelte"
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    import dayjs from "dayjs"
    import { fade } from "svelte/transition"

    export let credit;
    $: paiments = credit?.paiements;
</script>

<Layout>
    <div class="max-w-2xl px-6 mx-auto mt-6">
        <div>
            <h3 class="text-xl text-gray-800 md:text-2xl">Paiements</h3>
        </div>

        <!-- list of paiements -->
        <div class="px-4 py-5 mt-2 border-t rounded-t sm:px-6">
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    {#each paiments as paiement, i}
                    <li key={i} transition:fade={{ delay: 100 * i,duration: 200 }}>
                        <div class="flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-900">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-700 text-md dark:text-white md:truncate">
                                        {paiement.montant} DH, ID Contrat: {credit?.contrat?.id}, {paiement.type_paiement}
                                    </p>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center font-light text-gray-500 text-md dark:text-gray-300">
                                            {dayjs(paiement.created_at).format("DD-MM-YYYY HH:mm")}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-shrink-0 px-4">
                                <p class="flex p-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </p>
                            </div>
                        </div>
                    </li>
                    {/each}
                </ul>
            </div>
        </div>

        <!-- add btn -->
        <div class="flex justify-end px-4 py-5 mt-2 rounded-t sm:px-6">
            <Modal>
                <button slot="trigger" class="px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200">Ajouter un paiement</button>
                <AddPaiementForm credit={credit} />
            </Modal>
        </div>
    </div>
</Layout>
