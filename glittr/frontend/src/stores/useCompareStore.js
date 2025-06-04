import {defineStore} from 'pinia'
import {ref} from 'vue'

export const useCompareStore = defineStore('compare', () => {
    const items = ref([])
    const error = ref('')
    const modalCompare = ref(false)
    const selectedProductId = ref(null)


    function addProduct(product) {
        if (items.value.length >= 2) {
            error.value = 'Você só pode comparar até 2 produtos.'
            return
        }

        if (
            items.value.length === 1 &&
            items.value[0].attributes.category !== product.attributes.category
        ) {
            error.value = 'Os produtos precisam ser da mesma categoria para serem comparados.'
            return
        }

        const alreadyAdded = items.value.some(p => p.name === product.name)
        if (alreadyAdded) {
            error.value = 'Esse produto já está na comparação.'
            return
        }

        items.value.push(product)
        error.value = ''
    }

    function removeProduct(productName) {
        items.value = items.value.filter(p => p.name !== productName)
    }

    function clearError() {
        error.value = ''
    }


    function openModal(id) {
        selectedProductId.value = id
        modalCompare.value = true
    }

    function closeModal() {
        modalCompare.value = false
    }


    return {
        items,
        error,
        addProduct,
        removeProduct,
        clearError,
        modalCompare,
        openModal,
        closeModal,
        selectedProductId
    }
})
