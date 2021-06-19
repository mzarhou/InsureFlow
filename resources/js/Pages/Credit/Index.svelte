<script>
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    import { inertia } from "@inertiajs/inertia-svelte"
    import { Inertia } from "@inertiajs/inertia"
    import CheckBox from "@/Components/ui/CheckBox.svelte";
    import { fade } from "svelte/transition";
    const route = window.route;

    export let credits = [];

    $: Credits = credits.map(c => {
        c.vehicule = c.contrat?.vehicule;
        c.client = c.contrat?.vehicule?.client;
        c.montant_restant = c.contrat.montant_total - c.paiements.reduce((sum, paiement) => sum += paiement.montant, 0)
        return c;
    });

    let searchValue = "";
    let showCompleted = false;

    function handleSearch () {
        Inertia.get(
            route('credit.index') + '?search=' + searchValue + showCompleted || ''
        );
    }

    $: Inertia.get(
            route('credit.index') + ('?search=' + searchValue) + (showCompleted ? '&completed' : '')
        );
</script>

<Layout>
<div class="container max-w-4xl px-4 mx-auto sm:px-8">
    <div class="py-8">
        <div class="flex flex-row items-center justify-between w-full mb-1 sm:mb-0">
            <h2 class="text-2xl leading-tight">Credit</h2>
            <div class="text-end">
                <form on:submit|preventDefault={handleSearch} class="flex items-center w-full max-w-sm space-x-3">
                    <div class="">
                        <CheckBox bind:checked={showCompleted} label="complet" />
                    </div>
                    <div class="relative ">
                        <input bind:value={searchValue} type="text" class="flex-1 w-full px-4 py-2 text-base text-gray-700 placeholder-gray-400 bg-white border border-gray-100 rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="rechercher (nom, cin)"/>
                    </div>
                    <button type="submit" class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200">
                        Filtrer
                    </button>
                </form>
            </div>
        </div>
        <div class="px-4 py-4 -mx-4 overflow-x-auto sm:px-8">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Nom
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                cin
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                montant total
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                montant restant
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                matricule
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                complet
                            </th>
                            <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                        {#each Credits as credit, key}
                        <tr key={key} transition:fade={{ delay: 15 * key, duration: 200 }}>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <a href={route("gestion-clients.show", credit.client?.id)} use:inertia class="text-gray-900 whitespace-no-wrap">
                                    {credit.client?.nom}
                                </a>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {credit.client?.cin}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {credit.contrat?.montant_total}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {credit.montant_restant}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {credit.vehicule?.numero_immatriculation}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {#if credit.completed}
                                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    {/if}
                                </p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <a use:inertia href={route("credit.show", credit.id)} class="relative text-indigo-600 hover:text-indigo-900">
                                    Details
                                    {#if credit.paiements?.length > 0}
                                    <span class="absolute top-0 right-0 block w-4 h-4 -mt-2 -mr-2 text-xs font-semibold text-center text-white rounded-full bg-c-2">
                                        {credit.paiements?.length < 100 ? credit.paiements?.length : '...'}
                                    </span>
                                    {/if}
                                </a>
                            </td>
                        </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</Layout>
