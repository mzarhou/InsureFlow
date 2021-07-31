<script>
    import { inertia, page } from "@inertiajs/inertia-svelte";
    import { Inertia } from "@inertiajs/inertia";
    import Notification from "@/Components/app/Notification.svelte";
    import { useRoutes } from "./_hooks/useRoutes";
    import UseSidebar from "./_hooks/UseSidebar.svelte";

    let route = window?.route;
    const { routes } = useRoutes();

    function logout() {
        Inertia.post(route("logout"));
    }
</script>

<UseSidebar let:show let:openSidebar let:closeSidebar>
    {#if !show}
        <button
            on:click={openSidebar}
            class="absolute left-0 text-gray-600 open-btn"
        >
            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                ><path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h7"
                /></svg
            >
        </button>
    {/if}

    <Notification />

    <div class="h-screen md:flex">
        <div
            style="z-index: 110"
            class="absolute inset-y-0 z-50 bg-red-500 md:relative dark:bg-gray-800 sidebar"
        >
            <div class="flex flex-col bg-white sm:flex-row sm:justify-around">
                <button
                    class="absolute right-0 text-gray-600 close-btn"
                    on:click={closeSidebar}
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        ><path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        /></svg
                    >
                </button>
                <div class="h-screen w-72">
                    <nav class="px-6 mt-10 ">
                        {#each $routes as rt}
                            <a
                                href={route(rt.name)}
                                use:inertia
                                class="{rt.selected
                                    ? 'bg-gray-100 text-gray-800'
                                    : 'text-gray-600'} flex items-center p-2 my-3 transition-colors duration-200 rounded-lg hover:text-gray-800 hover:bg-gray-100"
                            >
                                {@html rt.icon}
                                <span class="mx-4 text-lg font-normal"
                                    >{rt.title}</span
                                >
                                <span class="flex-grow text-right" />
                            </a>
                        {/each}
                    </nav>
                    <div class="absolute bottom-0 my-10">
                        <form
                            on:submit|preventDefault={logout}
                            class="flex items-center px-8 py-2 text-gray-600 transition-colors duration-200 hover:text-gray-800"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                                ><path
                                    fill-rule="evenodd"
                                    d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                    clip-rule="evenodd"
                                /></svg
                            >
                            <button type="submit" class="mx-4 font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-grow h-screen overflow-y-auto">
            <slot />
        </div>
    </div>
</UseSidebar>

<style>
    .close-btn {
        margin-right: 10px;
        margin-top: 10px;
    }

    .open-btn {
        margin-left: 16px;
        margin-top: 10px;
    }
</style>
