<script>
    import ResiliationBtn from "../Index/ResiliationBtn.svelte";
    import dayjs from "dayjs"

    export let contrats = [];

    const isActive = (contrat) => dayjs(contrat.du_date).isBefore(dayjs(contrat.au_date));
</script>

<div class="mt-10 overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            Contrats
        </h3>
        <p class="max-w-2xl mt-1 text-sm text-gray-500">
            Details et informations sur les vehicules du client.
        </p>
    </div>
    <div class="overflow-x-auto border-t border-gray-200">
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                            Du
                        </th>
                        <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                            Au
                        </th>
                        <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                            Type de paiement
                        </th>
                        <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                            Montant Total
                        </th>
                        <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                            Matricule
                        </th>
                        <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                        </th>
                        <th scope="col" class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {#each contrats as contrat, key}
                    <tr key={key}>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {contrat.du_date}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {contrat.au_date}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {contrat.type_paiement}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {contrat.montant_total}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {contrat.vehicule.numero_immatriculation}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            {#if isActive(contrat)}
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                </span>
                                <span class="relative">
                                    actif
                                </span>
                            </span>
                            {:else}
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-gray-900">
                                <span aria-hidden="true" class="absolute inset-0 bg-gray-200 rounded-full opacity-50">
                                </span>
                                <span class="relative">
                                    pas actif
                                </span>
                            </span>
                            {/if}
                        </td>

                        {#if isActive(contrat)}
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <ResiliationBtn contrat={contrat} />
                        </td>
                        {/if}
                    </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
</div>
