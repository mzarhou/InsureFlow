
<script>
    import { gsap } from 'gsap'
    import { onMount } from 'svelte';
    import { inertia } from "@inertiajs/inertia-svelte"
    import { Inertia } from "@inertiajs/inertia"
    import Notification from '@/Components/app/Notification.svelte'
    let route = window?.route;

    let show = true;
    let sidebarWidth = 0;
    let documentWidth = 0;

    onMount(() => {
        sidebarWidth = document.getElementsByClassName("sidebar")[0].getBoundingClientRect().width
        documentWidth = document.body.getBoundingClientRect().width;

        window.onresize = () => {
            documentWidth = document.body.getBoundingClientRect().width;
        }
    })

    function closeSidebar () {
        show = false;
        gsap.to(".sidebar", {x: -sidebarWidth, width: 0, duration: .3});
    }

    function openSidebar () {
        show = true;
        gsap.to(".sidebar", {x: 0, width: sidebarWidth, duration: .3});
    }

    function logout () {
        Inertia.post(route("logout"));
    }
</script>

<!-- {#if $page.props.flash.message && showNotification} -->
<Notification />
<!-- {/if} -->

{#if !show}
    <button on:click={openSidebar} class="absolute left-0 text-gray-600 open-btn">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
    </button>
{/if}

<Notification />

<div class="h-screen md:flex">
    <div class="absolute inset-y-0 z-50 bg-white md:relative dark:bg-gray-800 sidebar">
        <div class="flex flex-col bg-white sm:flex-row sm:justify-around">
            <button class="absolute right-0 text-gray-600 close-btn" on:click={closeSidebar}>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="h-screen w-72">
                <!-- <div class="flex items-center justify-start mx-6 mt-10">
                    <img class="h-10" src="/icons/rocket.svg"/>
                    <span class="ml-4 text-2xl font-bold text-gray-600 dark:text-gray-300">
                        Tail-Kit
                    </span>
                </div> -->
                <nav class="px-6 mt-10 ">
                    <a href={route("index")} use:inertia class="{route().current('index') ? 'bg-gray-100 text-gray-800' : 'text-gray-600'} flex items-center p-2 my-5 transition-colors duration-200 rounded-lg hover:text-gray-800 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        <span class="mx-4 text-lg font-normal">
                            Accueil
                        </span>
                        <span class="flex-grow text-right">
                        </span>
                    </a>
                    <a href={route("gestion-clients.index")} use:inertia class="{route().current('gestion-clients.*') ? 'bg-gray-100 text-gray-800' : 'text-gray-600'} flex items-center p-2 my-5 transition-colors duration-200 rounded-lg hover:text-gray-800 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                        <span class="mx-4 text-lg font-normal">
                            Gestion Clients
                        </span>
                        <span class="flex-grow text-right">
                        </span>
                    </a>
                    <a use:inertia href={route("gestion-charges.index")} class="{route().current('gestion-charges.*') ? 'bg-gray-100 text-gray-800' : 'text-gray-600'} flex items-center p-2 my-5 transition-colors duration-200 rounded-lg hover:text-gray-800 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path></svg>
                        <span class="mx-4 text-lg font-normal">
                            Les charges
                        </span>
                        <span class="flex-grow text-right">
                        </span>
                    </a>
                    <a href={route("credit.index")}
                        use:inertia
                        class="{route().current('credit.*') ? 'bg-gray-100 text-gray-800' : 'text-gray-600'} flex items-center p-2 my-5 transition-colors duration-200 rounded-lg hover:text-gray-800 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                        <span class="mx-4 text-lg font-normal">
                            Credit
                        </span>
                        <span class="flex-grow text-right">
                        </span>
                    </a>
                    <a href={route("resiliation.index")}
                        use:inertia
                        class="{route().current('resiliation.*') ? 'bg-gray-100 text-gray-800' : 'text-gray-600'} flex items-center p-2 my-5 transition-colors duration-200 rounded-lg hover:text-gray-800 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <span class="mx-4 text-lg font-normal">
                            Resiliation
                        </span>
                        <span class="flex-grow text-right">
                        </span>
                    </a>
                </nav>
                <div class="absolute bottom-0 my-10">
                    <form on:submit|preventDefault={logout} class="flex items-center px-8 py-2 text-gray-600 transition-colors duration-200 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
                        <button type="submit" class="mx-4 font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow h-screen overflow-y-auto">
        <div class="pt-10">
            <slot />
        </div>
    </div>
</div>

<style>
.close-btn {
    margin-right: 40px;
    margin-top: 10px;
}

.open-btn {
    margin-left: 16px;
    margin-top: 10px;
}
</style>
