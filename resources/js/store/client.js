import { writable } from "svelte/store"


export const clientInfo = writable({
    personnelles: {
        nom: "",
        cin: "",
        tele: "",
        addresse: "",
    },

    vehicule: {
        puissance_energie: "",
        numero_immatriculation: "",
        marque_type: "",
        type_carrosserie: "",
        date_1er_mise_en: "",
        usage: "",
        cylindree: "",
        remorques: "",
        poids_total_en_charge: "",
        nombre_places: ""
    },

    contrat: {
        type_paiement: "",
        du_date: "",
        au_date: "",
        montant_total: ""
    }
})
