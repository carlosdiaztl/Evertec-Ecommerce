<template>
    <div>
        product components

        <!-- Accessing the data attribute of each product -->
        <div v-for="product in parsedProducts" :key="product.id">
            <p>Id: {{ product.id }}</p>
            <p>Title: {{ product.title }}</p>
            <p>Description: {{ product.description }}</p>
            <p>Stock: {{ product.stock }}</p>
            <p>Stock: {{ product.image }}</p>
            <img :src="getImageUrl(product.image)" alt="" />
        </div>
        <ul>
            <li v-for="link in paginationLinks" :key="link.url">
                <a :href="link.url">{{ link.label }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        products: {
            type: Array,
            required: true,
        },
        paginationLinks: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            parsedProducts: [],
            // Initialize an empty array for parsed products
        };
    },
    mounted() {


        this.parsedProducts = JSON.parse(this.products).data;
        console.log(this.parsedProducts);
    },
    methods: {
        getImageUrl(image) {
            return "https://localhost/Evertec-Ecommerce/public/" + image; // Concatenate the image URL with additional text
        },
    },
};
</script>
