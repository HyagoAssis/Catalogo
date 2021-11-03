<template>
  <div class="main">
    <div class="filter-list">
      <div class="filter-item">
        <label class="label-filters">Tipo</label>
        <select v-model="name" v-on:change="evenProducts">
          <option value="">Todas</option>
          <option v-for="type in this.types" :value="type.name">{{ type.name }}</option>
        </select>
      </div>
    </div>
    <div class="product-list">
      <template>
        <p v-if="firtsLoad === 0">Carregando...</p>
        <p v-if="evenProductsList.length === 0 && firtsLoad !== 0">
          Nenhum resultado encontrado
        </p>
        <div v-for="product in this.evenProductsList">
          <ProductCard
            class="product"
            :title="product.name"
            :type="product.type.name"
            :img="product.img_cover"
            :price="product.price"
          />
        </div>
      </template>
    </div>
    <div class="product-pagination">
      <template
        v-for="(page, index) in this.totalPages"
        v-if="evenProductsList.length !== 0"
      >
        <template v-if="pageAtual === page">
          <button class="page-active" v-on:click="setPage(page)">
            {{ page }}
          </button>
        </template>
        <template v-else>
          <button class="page-text" v-on:click="setPage(page)">
            {{ page }}
          </button>
        </template>
      </template>
    </div>
  </div>
</template>

<style>
.main .product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
}

.main .filter-list {
  display: flex;
  justify-content: center;
  border-width: 3px;
  border-color: #ededed;
  border-radius: 5px;
  border-style: solid;
  padding-top: 10px;
  padding-bottom: 10px;
}
.main .filter-list .filter-item {
  margin-right: 10px;
  margin-left: 10px;
}
.filter-item {
  background-color: #ededed;
  padding: 5px;
}
select {
  cursor: pointer;
  border-radius: 3px;
  padding: 3px;
  background-color: white;
  border: none;
}
select:hover {
  background-color: #df4617;
}
select:focus {
  background-color: white;
}
.main .product-pagination {
  display: flex;
  justify-content: center;
  margin-top: 10px;
  margin-bottom: 100px;
}

.main .product-pagination .page-text {
  border: 2px solid #ededed;
  background-color: #ededed;
  align-items: center;
  padding: 15px;
  font-size: 18px;
  border-radius: 20px;
  margin-right: 5px;
  margin-left: 5px;
  cursor: pointer;
}

.main .product-pagination .page-active {
  border: 2px solid black;
  background-color: black;
  color: white;
  align-items: center;
  padding: 15px;
  font-size: 18px;
  border-radius: 20px;
  margin-right: 5px;
  margin-left: 5px;
  cursor: pointer;
}

.main .product-pagination .page-active:hover {
  border: 2px solid #df4617;
}

.main .product-pagination .page-text:hover {
  border: 2px solid #df4617;
  color: #df4617;
}
</style>

<script>
import ProductCard from "../components/ProductCard.vue";

var axios = require("axios").default;

var options = {
  method: "POST",
  url: "https://scrapingant.p.rapidapi.com/post",
  headers: {
    "content-type": "application/json",
    "x-rapidapi-host": process.env.MIX_API_HOST,
    "x-rapidapi-key": process.env.MIX_API_KEY,
  },
  data: {
    cookies: "cookie_name_1=cookie_value_1;cookie_name_2=cookie_value_2",
    return_text: false,
    url: "https://chicorei.com/roupas/?per_page=120",
  },
};

export default {
  name: "ProductList",
  data() {
    return {
      name: "",
      evenProductsList: [],
      pageAtual: 1,
      ofset: 12,
      tam: 0,
      products: [],
      types: [],
      firtsLoad: 0,
    };
  },
  components: {
    ProductCard,
  },
  methods: {
    paginate() {
      let pageAtual = this.pageAtual;
      let ofset = this.ofset;
      let i = 0;

      this.evenProductsList = this.evenProductsList.filter(function (value) {
        i++;
        return i > (pageAtual - 1) * ofset && i <= pageAtual * ofset;
      });

      if (pageAtual > this.totalPages) this.setPage(1);
    },
    evenProducts() {
      name = this.name;
      let i = 0;
      this.evenProductsList = this.products.filter(function (value) {
        if (value.type.name === name || name === "") {
          i++;
          return true;
        } else return false;
      });
      this.tam = i;
      this.paginate();
    },
    setPage(pageNumber) {
      this.pageAtual = pageNumber;
      this.evenProducts();
      window.scrollTo(0, 0);
    },
  },
  computed: {
    totalPages: function () {
      if (this.tam !== 0) return Math.ceil(this.tam / this.ofset);
      else return Math.ceil(this.products.length / this.ofset);
    },
  },
  async mounted() {
    const response = await axios
      .request(options)
      .then(function (response) {
        return response.data;
      })
      .catch(function (error) {
        return null;
        console.error(error);
      });
    let result = response.substring(
      response.lastIndexOf('{"state":"vueProducts"'),
      response.indexOf(";var popListener=function(event)")
    );
    let request = JSON.parse(result);
    this.products = request.products.hits;
    this.types = request.filters.types;
    this.evenProductsList = this.products;
    this.paginate();
    this.firtsLoad = 1;
  },
};
</script>
