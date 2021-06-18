<script>
    export let vehicules;
</script>

<div class="mt-10 overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            Vehicules
        </h3>
        <p class="max-w-2xl mt-1 text-sm text-gray-500">
            Details et informations sur les vehicules du client.
        </p>
    </div>
    <div class="overflow-x-scroll border-t border-gray-200">
        <table class="table w-full p-4 bg-white border-none rounded-lg shadow">
            <thead>
                <tr>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">puissance_energie</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">numero_immatriculation</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">marque_type</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">type_carrosserie</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">date_1er_mise_en</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">usage</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">cylindree</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">remorques</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">poids_total_en_charge</th>
                    <th class="p-4 font-normal text-gray-900 border whitespace-nowrap">nombre_places</th>
                </tr>
            </thead>
            <tbody>
                {#each vehicules as vehicule}
                <tr class="text-gray-700">
                    <td class="p-4 border">{vehicule.puissance_energie}</td>
                    <td class="p-4 border">{vehicule.numero_immatriculation}</td>
                    <td class="p-4 border">{vehicule.marque_type}</td>
                    <td class="p-4 border">{vehicule.type_carrosserie}</td>
                    <td class="p-4 border">{vehicule.date_1er_mise_en}</td>
                    <td class="p-4 border">{vehicule.usage}</td>
                    <td class="p-4 border">{vehicule.cylindree}</td>
                    <td class="p-4 border">{vehicule.remorques}</td>
                    <td class="p-4 border">{vehicule.poids_total_en_charge}</td>
                    <td class="p-4 border">{vehicule.nombre_places}</td>
                </tr>
                {/each}
            </tbody>
        </table>
    </div>
</div>
