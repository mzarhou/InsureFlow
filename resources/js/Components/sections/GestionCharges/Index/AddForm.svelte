<script>
    import Modal from "@/Components/app/Modal.svelte";
    import { useForm } from "@inertiajs/inertia-svelte";

    let montantElement;
    let addForm = useForm({
        montant: "",
        description: ""
    })


    function ajouter() {
        $addForm.post(route("gestion-charges.store"), {
            onSuccess() {
                $addForm.montant = ""
                $addForm.description = ""
                montantElement?.focus()
            }
        });
    }
</script>

<Modal>
    <button slot="trigger" class="px-16 py-2 mt-4 mr-4 text-lg font-semibold text-white bg-yellow-500 rounded-lg">+</button>
    <!-- form -->
    <form on:submit|preventDefault={ajouter} class="max-w-sm p-4 bg-white rounded-lg">
        <input bind:this={montantElement} bind:value={$addForm.montant} type="text" placeholder="Montant (DH)" class:!border-red-500={$addForm.errors.montant} class="w-full px-4 py-2 border border-gray-200 rounded-md" />
        {#if $addForm.errors.montant}
            <p class="ml-1 text-sm text-red-500">{$addForm.errors.montant}</p>
        {/if}
        <textarea bind:value={$addForm.description} type="text" placeholder="Description" class:!border-red-500={$addForm.errors.description} class="w-full px-4 py-2 mt-4 border border-gray-200 rounded-md"></textarea>
        {#if $addForm.errors.description}
            <p class="text-red-500">{$addForm.errors.description}</p>
        {/if}
        <div class="flex justify-end ml-1 text-sm">
            <button type="submit" class="px-4 py-2 mt-4 text-white bg-green-500 rounded-lg">Ajouter</button>
        </div>
    </form>
</Modal>
