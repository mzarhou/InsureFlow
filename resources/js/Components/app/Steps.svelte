<script>
    export let step = 2;

    let steps = [
        {
            title: 'Informations Personnelles',
            icon: `<svg class="w-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>`
        },
        {
            title: 'Informations sur le véhicule',
            icon: `<svg class="w-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>`
        },
        {
            title: 'Contrat',
            icon: `<svg class="w-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>`
        },
        {
            title: 'Terminer',
            icon: `<svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg>`
        }
    ]

    const getWidth = (index, step) => {
        if (index <= (step - 1))
            return 100;
        else if (index === step)
            return 30;
        else
            return 0;
    }
</script>

<div class="w-full max-w-5xl py-6 mx-auto">
    <div class="flex">

        {#each steps as st, i}
            <div style="width: {100 / steps?.length}%;">
                <div class="relative mb-2">
                    {#if i !== 0}
                    <div class="absolute flex items-center content-center align-middle align-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                        <div class="items-center flex-1 w-full align-middle bg-gray-200 rounded align-center">
                            <div class="w-0 py-1 bg-green-300 rounded" style="width: {getWidth(i, step)}%;"></div>
                        </div>
                    </div>
                    {/if}

                    <div class="{i < step ? 'bg-green-500' : 'bg-gray-300'} flex items-center w-10 h-10 mx-auto text-lg text-white rounded-full">
                        <span class="w-full p-1 text-center text-white">
                            {@html st?.icon}
                        </span>
                    </div>
                </div>

                <div class="text-xs text-center md:text-base">{st?.title}</div>
            </div>
        {/each}
    </div>
</div>
