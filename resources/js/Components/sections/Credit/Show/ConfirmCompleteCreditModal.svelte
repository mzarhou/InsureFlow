<script>
    import Modal from "@/Components/app/Modal.svelte";
    import { Inertia } from "@inertiajs/inertia"

    let route = window.route;

    export let credit;

    function handleSubmit () {
        Inertia.put(route("credit.complete", credit?.id));
    }
</script>

<Modal let:close>
    <button slot="trigger" class="flex items-center px-4 py-2 bg-green-100 rounded-md">
        <span>Finaliser le credit</span>
        <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </button>

    <div class="w-64 p-4 m-auto bg-white shadow-lg rounded-2xl dark:bg-gray-800">
        <div class="w-full h-full text-center">
            <div class="flex flex-col justify-between h-full">
                <svg width="40" height="40" class="w-12 h-12 m-auto mt-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>

                <p class="mt-4 text-xl font-bold text-gray-800">
                    Finaliser
                </p>
                <p class="px-6 py-2 text-xs text-gray-600">
                    Êtes-vous sûr de vouloir finalizer ce credit ?
                </p>
                <div class="flex items-center justify-between w-full gap-4 mt-8">
                    <button on:click={handleSubmit} type="button" class="w-full px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-green-500 rounded-lg shadow-md hover:bg-green-700 focus:ring-green-500 focus:ring-offset-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                        Finalizer
                    </button>
                    <button on:click={close} type="button" class="w-full px-4 py-2 text-base font-semibold text-center text-gray-700 transition duration-200 ease-in bg-white rounded-lg shadow-md hover:bg-gray-100 focus:ring-green-500 focus:ring-offset-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</Modal>
