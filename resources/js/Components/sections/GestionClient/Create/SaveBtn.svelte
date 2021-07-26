<script>
    import Modal from "@/Components/app/Modal.svelte";
    import { Inertia } from "@inertiajs/inertia"
    import { clientInfo } from "@/store/client";

    let route = window.route;

    let showConfirmModal = false;

    function handleSubmit () {
        Inertia.post(route("gestion-clients.store"), $clientInfo);
    }
</script>

<Modal on:trigger bind:show={showConfirmModal}>
    <button slot="trigger" class="justify-self-end flex px-4 py-2 text-white bg-green-400 rounded-md">
        Enregistrer
        <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </button>

    <div class="rounded-2xl dark:bg-gray-800 w-64 p-4 m-auto bg-white shadow-lg">
        <div class="w-full h-full text-center">
            <div class="flex flex-col justify-between h-full">
                <svg width="40" height="40" class="w-12 h-12 m-auto mt-4 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <p class="dark:text-gray-200 mt-4 text-xl font-bold text-gray-800">
                    Confirmer
                </p>
                <p class="dark:text-gray-400 px-6 py-2 text-xs text-gray-600">
                    Êtes-vous sûr de vouloir l'enregistrer ?
                </p>
                <div class="flex items-center justify-between w-full gap-4 mt-8">
                    <button on:click={handleSubmit} type="button" class="hover:bg-green-700 focus:ring-green-400 focus:ring-offset-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 w-full px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-green-500 rounded-lg shadow-md">
                        Enregistrer
                    </button>
                    <button on:click={() => showConfirmModal = false} type="button" class="hover:bg-gray-100 focus:ring-green-400 focus:ring-offset-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 w-full px-4 py-2 text-base font-semibold text-center text-green-400 transition duration-200 ease-in bg-white rounded-lg shadow-md">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</Modal>
