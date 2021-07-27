<script context="module">
    import Layout from "@/Pages/Layouts/AdminLayout.svelte"
    export const layout = Layout
</script>

<script>
    import { inertia } from "@inertiajs/inertia-svelte"
    import Pagination from "@/Components/app/Pagination.svelte"
    import { Inertia } from "@inertiajs/inertia"

    export let clients;

    let route = window.route;

    let search = "";
    let searched = false;

    function handleSearch () {
        Inertia.get(
            route('gestion-clients.index') + '?search=' + search
        );
        searched = true;
    }
</script>

<main class="mrg-left p-4">
    <div class="flex flex-wrap-reverse justify-between -mt-4">
        <a use:inertia href={route("gestion-clients.create")} class="px-16 py-2 mt-4 mr-4 text-lg font-semibold text-white bg-yellow-500 rounded-lg">+</a>

        <form on:submit|preventDefault={handleSearch} class="flex items-center justify-end flex-grow mt-4">
            <input bind:value={search} placeholder="rechercher" class="md:w-auto form-input focus:ring-2 focus:ring-yellow-500 w-full px-4 py-2 mr-2 border rounded-lg outline-none"/>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 font-semibold text-white bg-yellow-500 rounded-lg">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </form>
    </div>
    <table class="table w-full p-4 mt-4 bg-white rounded-lg shadow">
        <thead>
            <tr>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    #
                </th>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    Nom
                </th>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    CIN
                </th>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    Tele
                </th>
                <th class="dark:border-dark-5 whitespace-nowrap p-4 font-normal text-gray-900 border">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            {#each clients.data as client}
            <tr class="text-gray-700">
                <td class="dark:border-dark-5 p-4 border">
                    {client?.id}
                </td>
                <td class="dark:border-dark-5 p-4 border">
                    {client?.nom}
                </td>
                <td class="dark:border-dark-5 p-4 border">
                    {client?.cin}
                </td>
                <td class="dark:border-dark-5 p-4 border">
                    {client?.tele}
                </td>
                <td class="dark:border-dark-5 p-4 text-center border">
                    <a href={route("gestion-clients.show", client?.id)} use:inertia class="text-green-500">Details</a>
                </td>
            </tr>
            {/each}
        </tbody>
    </table>
    <Pagination links={clients.links} search={search} searched={searched} />
</main>
