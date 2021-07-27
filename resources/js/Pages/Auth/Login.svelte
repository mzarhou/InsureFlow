<script context="module">
    import Layout from "@/Pages/Layouts/AuthLayout.svelte"
    export const layout = Layout
</script>

<script>
    import { Inertia } from "@inertiajs/inertia";

    export let errors = {};

    $: displayErrors = (function () {
        return Object.keys(errors).map((key) => errors[key]);
    })();

    let email = "";
    let password = "";

    function handleSubmit(e) {
        e.preventDefault();

        Inertia.post(
            "/login",
            { email, password },
            {
                replace: true,
            }
        );
    }
</script>

<div class="bg-c-1 place-content-center grid h-screen">
    <div class="w-screen">
        {#if displayErrors?.length > 0}
            <div class="max-w-lg px-4 mx-auto mb-4">
                <ul class="p-4 bg-white rounded-lg">
                    {#each displayErrors as err}
                        <li class="text-red-500">{err}</li>
                    {/each}
                </ul>
            </div>
        {/if}
        <form class="max-w-lg mx-auto" on:submit={handleSubmit}>
            <div class="flex flex-col px-4">
                <div class="relative text-gray-400">
                    <input
                        bind:value={email}
                        class="p-4 pl-12 text-xl text-gray-800 border rounded-t-lg"
                        type="text"
                        placeholder="Email"
                    />
                    <svg
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        ><path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        /></svg
                    >
                </div>
                <div class="relative text-gray-400">
                    <input
                        bind:value={password}
                        class="p-4 pl-12 text-xl text-gray-800 border rounded-b-lg"
                        type="password"
                        placeholder="*********************"
                    />
                    <svg
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        ><path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"
                        /></svg
                    >
                </div>
            </div>
            <button
                type="submit"
                class="rounded-3xl bg-c-2 block w-1/2 px-4 py-3 mx-auto mt-8 text-lg font-semibold text-white"
                >Login</button
            >
        </form>
    </div>
</div>

<style>
    svg {
        --size: 30px;
        position: absolute;
        margin-top: calc(-1 * var(--size) / 2);
        margin-left: 10px;
        height: var(--size);
        width: var(--size);
        top: 50%;
    }

    input {
        outline: none;
        width: 100%;
    }
</style>
