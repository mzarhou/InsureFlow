<script>
    import Modal from "@/Components/app/Modal.svelte";
    import { Inertia } from "@inertiajs/inertia"

    let route = window.route;

    let showConfirmModal = false;

    export let charge;

    const onSuccess = () => showConfirmModal = false;
    function handleSubmit () {
        Inertia.delete(route("gestion-charges.destroy", charge?.id), {
            onSuccess
        });
    }
</script>

<Modal bind:show={showConfirmModal}>
    <button slot="trigger" class="">
        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
    </button>

    <div class="w-64 p-4 m-auto bg-white shadow-lg rounded-2xl dark:bg-gray-800">
        <div class="w-full h-full text-center">
            <div class="flex flex-col justify-between h-full">
                <svg width="40" height="40" class="w-12 h-12 m-auto mt-4 text-red-500" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z">
                    </path>
                </svg>
                <p class="mt-4 text-xl font-bold text-gray-800 dark:text-gray-200">
                    Supprimer
                </p>
                <p class="px-6 py-2 text-xs text-gray-600 dark:text-gray-400">
                    Êtes-vous sûr de vouloir supprimer cet enregistrement ?
                </p>
                <div class="flex items-center justify-between w-full gap-4 mt-8">
                    <button on:click={handleSubmit} type="button" class="w-full px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-red-600 rounded-lg shadow-md hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                        Supprimer
                    </button>
                    <button on:click={() => showConfirmModal = false} type="button" class="w-full px-4 py-2 text-base font-semibold text-center text-gray-700 transition duration-200 ease-in bg-white rounded-lg shadow-md hover:bg-gray-100 focus:ring-red-500 focus:ring-offset-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</Modal>
