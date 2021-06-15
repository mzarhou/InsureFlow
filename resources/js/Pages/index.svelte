<script>
    import { onMount } from 'svelte'


    let name = "";

    // onMount(() => {
    //     document.getElementById('email').focus()
    //     const allInputs = document.querySelectorAll('input');
    //     for(const input of allInputs) {
    //         input.addEventListener('input', () => {
    //             const val = input.value
    //             if(!val) {
    //                 input.parentElement.classList.add('empty')
    //             } else {
    //                 input.parentElement.classList.remove('empty')
    //             }
    //         })
    //     }
    // })
</script>

<!-- component -->
<div class="flex justify-center h-screen items-center bg-c-1 px-2">
    <!-- This is the input component -->
    <div class="flex flex-col">
        <div class="relative h-20 input-component items-center rounded-t-lg overflow-hidden">
            <input
                id="name"
                type="text"
                name="name"
                bind:value={name}
                class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm border"
            />
            {name}
            <label for="name" class:filled={name?.length > 0} class="absolute left-2 transition-all bg-white px-1 colors.gray.300 text-gray-600">
                Name
            </label>
        </div>
        <!-- This is the input component -->
        <div class="relative h-10 input-component rounded-b-lg overflow-hidden">
            <input
                id="email"
                type="text"
                name="email"
                class="h-full w-full border-gray-300 px-2 transition-all border-blue rounded-sm"
            />
            <label for="email" class="absolute left-2 transition-all bg-white px-1 text-gray-600">
                E-mail
            </label>
        </div>

        <button class="bg-c-2 text-white rounded-3xl w-1/2 mt-4 px-4 py-2 block mx-auto text-center">Login</button>
    </div>

</div>

<style>
    input + label {
        top: 50%;
        margin-top: -13px;
        transition-duration: 200ms;
    }

    .filled, input:focus + label {
        top: 0%;
        font-size: 12px;
    }

    input {
        outline: none;
    }

/* label {
  top: 0%;
  transform: translateY(0%);
  font-size: 11px;
  color: rgba(37, 99, 235, 1);
}
input:not(:focus) + label {
  color: rgba(70, 70, 70, 1);
}
input {
  border-width: 1px;
}
input:focus {
  outline: none;
  border-color: rgba(37, 99, 235, 1);
} */
</style>
