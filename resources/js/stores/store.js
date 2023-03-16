import { defineStore } from 'pinia'

export const useStore = defineStore({
    id: 'main',
    state: () => ({
        editSuccess: false,
    }),
   
    actions: {
        setEditSuccess() {
            this.editSuccess = true;
        },
    },
})