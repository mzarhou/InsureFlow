<script context="module">
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    export const layout = Layout
</script>

<script>
    import Modal from "@/Components/app/Modal.svelte";
    import AddPaiementForm from "@/Components/sections/Credit/Show/AddPaiementForm.svelte"
    import ConfirmCompleteCreditModal from "@/Components/sections/Credit/Show/ConfirmCompleteCreditModal.svelte";
    import dayjs from "dayjs"
    import { fade } from "svelte/transition"

    export let credit;
    $: paiments = credit?.paiements;
    $: montant_restant = credit.contrat.montant_total - credit.paiements.reduce((sum, paiement) => sum += paiement.montant, 0)
</script>

<div class="max-w-2xl px-6 mx-auto mt-6">
    <!-- add btn -->
    {#if ! credit.completed}
    <div class="flex items-center justify-between py-5 mt-2 rounded-t">
        <div class="text-gray-600">
            Montant Restant: {montant_restant} DH
        </div>
        <ConfirmCompleteCreditModal credit={credit} />
    </div>
    {/if}
    <div class="flex justify-between">
        <h3 class="md:text-2xl text-xl text-gray-800">Paiements</h3>
        {#if credit.completed}
        <p class="flex items-center px-4 py-2 bg-green-100" title={dayjs(credit.completed).format("DD/MM/YYYY HH:mm")}>
            <span>Complet</span>
            <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
        </p>
        {/if}
    </div>
    <div class="sm:px-6 px-4 py-5 mt-2 border-t rounded-t">
        {#if paiments?.length > 0}
        <!-- list of paiements -->
        <div class="sm:rounded-md overflow-hidden bg-white shadow">
            <ul class="divide-y divide-gray-200">
                {#each paiments as paiement, i}
                <li key={i} transition:fade={{ delay: 100 * i,duration: 200 }}>
                    <div class="hover:bg-gray-50 dark:hover:bg-gray-900 flex items-center justify-between">
                        <div class="sm:px-6 px-4 py-4">
                            <div class="flex items-center justify-between">
                                <p class="text-md dark:text-white md:truncate text-gray-700">
                                    {paiement.montant} DH, ID Contrat: {credit?.contrat?.id}, {paiement.type_paiement}
                                </p>
                            </div>
                            <div class="sm:flex sm:justify-between mt-2">
                                <div class="sm:flex">
                                    <p class="text-md dark:text-gray-300 flex items-center font-light text-gray-500">
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
        {:else}
            <h3 class="md:text-4xl mt-6 text-xl text-center text-gray-400">Il n'y a pas de paiements</h3>
        {/if}
    </div>
    {#if ! credit.completed}
    <!-- add btn -->
    <div class="sm:px-6 flex justify-end px-4 py-5 mt-2 rounded-t">
        <Modal let:close>
            <button slot="trigger" class="hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md">Ajouter un paiement</button>
            <AddPaiementForm closeModal={close} credit={credit} />
        </Modal>
    </div>
    {/if}
</div>
