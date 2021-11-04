<template>
  <div class="product-container">
    <img :src="img" alt="Camiseta" loading="lazy" />
    <div class="product-content">
      <p class="product-name">{{ title }}</p>
      <p class="product-price">R$ {{ price.toFixed(2) }}</p>
      <p class="product-portion">4x R$ {{ (price / 4).toFixed(2) }}</p>
    </div>
  </div>
</template>

<style>
.product-container img {
  width: 250px;
  margin-top: 25px;
}
.product-container .product-content .product-name {
  margin-top: 5px;
  margin-bottom: 0px;
  font-size: 16px;
  font-family: "Roboto", sans-serif;
}

.product-container .product-content .product-price {
  margin-top: 5px;
  margin-bottom: 5px;
  font-size: 20px;
  font-family: "Roboto", sans-serif;
  font-weight: 700;
}
.product-container .product-content .product-portion {
  margin-top: 0px;
  margin-bottom: 0px;
  font-family: "Roboto", sans-serif;
}
</style>

<script>
export default {
  props: {
    title: String,
    type: String,
    price: Number,
    img: String,
    key: Number,
  },
  name: "ProductCard",
};
</script>
