<script>
    import Modal from "@/Components/app/Modal.svelte";
    import { useForm } from "@inertiajs/inertia-svelte";

    let montantElement;
    let addForm = useForm({
        montant: "",
        description: ""
    })


    function ajouter() {
        $addForm.post(route("gestion-charges.store"));
        $addForm.montant = ""
        $addForm.description = ""
        montantElement?.focus()
    }
</script>

<Modal>
    <button slot="trigger" class="px-16 py-2 mt-4 mr-4 text-lg font-semibold text-white bg-yellow-500 rounded-lg">+</button>
    <!-- form -->
    <form on:submit|preventDefault={ajouter} class="max-w-sm p-4 bg-white rounded-lg">
        <input bind:this={montantElement} bind:value={$addForm.montant} type="number" placeholder="Montant (DH)" class="w-full px-4 py-2 border border-gray-200 rounded-md" />
        <textarea bind:value={$addForm.description} type="text" placeholder="Description" class="w-full px-4 py-2 mt-4 border border-gray-200 rounded-md"></textarea>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 mt-4 text-white bg-green-500 rounded-lg">Ajouter</button>
        </div>
    </form>
</Modal>
