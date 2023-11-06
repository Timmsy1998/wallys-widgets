<template>
    <div>
        <h1>Place an Order</h1>
        <p class="text-muted">Enter the quantity of widgets you want to order.</p>
        <div class="button-container">
            <p class="text-muted">Or choose from suggested quantities:</p>
            <button v-for="size in suggestedSizes" @click="setQuantity(size)" class="btn btn-secondary" type="button"
                :class="{ active: widgetQuantity === size }">
                {{ size }}
            </button>
        </div>
        <form @submit.prevent="placeOrder">
            <div class="form-group mt-3">
                <label for="widgetQuantity">Enter Quantity:</label>
                <input v-model="widgetQuantity" type="number" id="widgetQuantity" class="form-control" min="0" step="1">
                <small class="text-muted">Please enter a positive integer.</small>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Place Order</button>
        </form>
        <div v-if="successMessage" class="alert alert-success mt-3">
            {{ successMessage }}
        </div>
        <div v-if="errorMessage" class="alert alert-danger mt-3">
            {{ errorMessage }}
        </div>
    </div>
</template>

<script>
import apiService from '../../services/apiService';

export default {
    data() {
        return {
            widgetQuantity: 0,
            suggestedSizes: [250, 500, 750, 1000],
            successMessage: '',
            errorMessage: '',
        };
    },
    methods: {
        placeOrder() {
            const orderSize = this.widgetQuantity;

            apiService.createOrder({ orderSize })
                .then((response) => {
                    // Calculate and format the packs and quantities
                    const packs = response.data.packs;
                    const formattedPacks = packs.map((pack) => `${pack} x ${packs.filter((p) => p === pack).length}`).filter((pack, index, self) => self.indexOf(pack) === index).join(', ');

                    this.successMessage = `Order placed successfully. You will receive: ${formattedPacks}`;
                    this.errorMessage = ''; // Clear any previous error message
                })
                .catch((error) => {
                    this.errorMessage = 'Error placing order. Please try again.';
                    this.successMessage = ''; // Clear any previous success message
                });
        },
        setQuantity(size) {
            if (size === this.widgetQuantity) {
                this.widgetQuantity = 0; // Deselect the size if it's already selected
            } else {
                this.widgetQuantity = size; // Set the selected size
            }
        },
    },
};
</script>


<style scoped>
.active {
    background-color: #007bff;
    color: #fff;
}
</style>
